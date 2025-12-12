<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index(Request $request)
    {
        $events = Event::where('starts_at', '>', now())
            ->orderBy('starts_at')
            ->paginate(6)
            ->through(function ($event) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'description' => $event->description,
                    'starts_at' => $event->starts_at->format('Y.m.d. H:i'),
                    'image_url' => $event->image_path ? Storage::url($event->image_path) : null,
                    'remaining' => $event->remainingSeats(),
                    'is_full' => $event->isFull(),
                ];
            });

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $data = $request->validate([
            'name' => 'required|string|min:5',
            'starts_at' => 'required|date|after:now',
            'description' => 'nullable|string|max:5000',
            'limit' => 'required|integer|min:1',
            'image' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image_path'] = $path;
        }

        $data['user_id'] = $request->user()->id;

        Event::create($data);

        //return redirect()->route('events.index')->with('success', 'Sikeres mentés');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();

        //return redirect()->route('events.index')->with('success', 'Esemény törölve');
    }
}
