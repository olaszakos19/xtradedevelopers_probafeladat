<template>
    <div class="border rounded p-4 shadow bg-white">
        <h2 class="text-lg font-bold">{{ event.name }}</h2>
    </div>
</template>

<script>
export default {
    name: "EventCard",
    props: {
        event: Object,
    },
};
</script>
