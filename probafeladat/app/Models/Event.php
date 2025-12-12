<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'name', 'description', 'starts_at', 'limit', 'image_path'];

    protected $dates = ['starts_at'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
