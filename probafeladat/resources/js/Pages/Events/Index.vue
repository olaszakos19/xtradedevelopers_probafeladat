<template>
    <div class="max-w-5xl mx-auto py-10 px-4">

        <!-- NAVBAR -->
        <div class="flex justify-end mb-6 space-x-3">

            <!-- Ha nincs belépve -->
            <template v-if="!$page.props.auth || !$page.props.auth.user">
                <Link
                    href="/login"
                    class="px-4 py-2 bg-blue-600 text-white rounded"
                >
                    Bejelentkezés
                </Link>

                <Link
                    href="/register"
                    class="px-4 py-2 bg-green-600 text-white rounded"
                >
                    Regisztráció
                </Link>
            </template>

            <!-- Ha be van lépve -->
            <template v-else>
                <form @submit.prevent="logout">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded"
                    >
                        Kilépés
                    </button>
                </form>
            </template>

        </div>

        <!-- Cím + Add Event gomb -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Események</h1>

            <!-- Hozzáadás gomb, csak ha be van lépve -->
            <template v-if="$page.props.auth && $page.props.auth.user">
                <Link
                    href="/events/create"
                    class="px-4 py-2 bg-green-600 text-white rounded"
                >
                    + Új esemény
                </Link>
            </template>
        </div>

        <!-- Event grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <EventCard
                v-for="event in events.data"
                :key="event.id"
                :event="event"
            />
        </div>

    </div>
</template>

<script>
import { Link, router } from "@inertiajs/vue3";
import EventCard from "@/Components/EventCard.vue";

export default {
    name: "EventsIndex",
    components: { EventCard, Link },
    props: {
        events: Object,
    },
    methods: {
        logout() {
            router.post("/logout");
        }
    }
};
</script>
