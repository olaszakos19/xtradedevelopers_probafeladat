<template>
    <div
        class="border rounded-xl p-6 shadow-lg bg-white flex flex-col transition transform hover:-translate-y-1 hover:shadow-2xl duration-300"
    >
        <!-- Esemény neve és dátuma -->
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            {{ event.name }}
        </h2>
        <h3 class="text-md font-medium text-gray-600 mb-4">
            Dátum: {{ event.starts_at }}
        </h3>

        <!-- Saját esemény műveletek -->
        <template v-if="auth && auth.user && auth.user.id === event.user_id">
            <div class="mt-auto flex gap-3">
                <Link
                    :href="`/events/${event.id}/edit`"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium flex-1 text-center shadow transition duration-300"
                >
                    Módosítás
                </Link>

                <button
                    @click="confirmDelete"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium flex-1 text-center shadow transition duration-300"
                >
                    Törlés
                </button>
            </div>
        </template>

        <template v-if="auth && auth.user">
            <div class="mt-4">
                <!-- Már jelentkeztél -->
                <button
                    v-if="alreadyJoined"
                    class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg font-medium cursor-not-allowed shadow"
                    disabled
                >
                    Már jelentkeztél
                </button>

                <!-- Betelt -->
                <button
                    v-else-if="event.is_full"
                    class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg font-medium cursor-not-allowed shadow"
                    disabled
                >
                    BETELT
                </button>

                <!-- Jelentkezem -->
                <button
                    v-else
                    @click="signup"
                    class="w-full px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium shadow transition duration-300"
                >
                    Jelentkezem
                </button>
            </div>
        </template>
    </div>
</template>

<script>
import { Link, router } from "@inertiajs/vue3";

export default {
    name: "EventCard",
    components: { Link },
    props: {
        event: Object,
        auth: Object,
    },
    methods: {
        confirmDelete() {
            if (!confirm("Biztosan törölni szeretnéd az eseményt?")) return;

            router.delete(
                `/events/${this.event.id}`,
                {},
                {
                    onSuccess: () => {
                        alert("Esemény sikeresen törölve!");
                        router.reload(); // frissítjük az oldalt
                    },
                    onError: (errors) => {
                        alert(errors[0] || "Hiba történt a törlés során.");
                    },
                }
            );
        },
        signup() {
            if (!confirm("Biztosan jelentkezni szeretnél az eseményre?"))
                return;

            router.post(
                `/events/${this.event.id}/signup`,
                {},
                {
                    onSuccess: () => {
                        alert("Sikeres jelentkezés!");
                        router.reload();
                    },
                    onError: (errors) => {
                        alert(errors[0] || "Hiba történt.");
                    },
                }
            );
        },
    },
};
</script>
