<script setup>
import Layout from '../../Layout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    events: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Layout>
        <h1>Events</h1>

        <ul v-if="events.length">
            <li v-for="event in events" :key="event.id">
                {{ event.id }} — {{ event.title }} - {{ event.start_date }}
                <Link :href="`/events/${event.id}`">View</Link>
            </li>
        </ul>

        <p v-else>No events yet.</p>
    </Layout>
</template>