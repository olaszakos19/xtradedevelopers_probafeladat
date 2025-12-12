<template>
  <div class="border rounded p-4 shadow bg-white flex flex-col">

    <h2 class="text-lg font-bold mb-2">Esemény neve: {{ event.name }}</h2>
    <h2 class="text-lg font-bold mb-2">Edemény dátuma: {{ event.starts_at }}</h2>
    

    
    <template v-if="auth && auth.user && auth.user.id === event.user_id">
      <div class="mt-auto flex gap-2">
        <!-- Módosítás -->
        <Link
          :href="`/events/${event.id}/edit`"
          class="px-3 py-1 bg-blue-600 text-white rounded text-sm text-center flex-1"
        >
          Esemény módosítása
        </Link>

        <!-- Törlés -->
        <Link
          as="button"
          method="delete"
          :href="`/events/${event.id}`"
          class="px-3 py-1 bg-red-600 text-white rounded text-sm text-center flex-1"
          @click.prevent="confirmDelete"
        >
          Törlés
        </Link>
      </div>
    </template>

  </div>
</template>

<script>
import { Link, router } from '@inertiajs/vue3'

export default {
  name: 'EventCard',
  components: { Link },
  props: {
    event: Object,
    auth: Object,
  },
  methods: {
    confirmDelete() {
      if (confirm('Biztosan törölni szeretnéd az eseményt?')) {
        router.delete(`/events/${this.event.id}`)
      }
    }
  }
}
</script>


