<script setup>
import Layout from '../../Layout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    events: {
        type: Array,
        required: true,
    },
});

function refreshEvents() {
    router.reload({
        only: ['events'],
    });
}
</script>

<template>
    <Head>
        <title>Events</title>
        <meta name="description" content="Browse all events on Inertia2">
    </Head>

    <Layout>
        <h1>Events</h1>

        <ul v-if="events.length">
            <li v-for="event in events" :key="event.id">
                {{ event.id }} — {{ event.title }} - {{ event.start_date }}
                <Link :href="`/events/${event.id}`">View</Link>
            </li>
        </ul>

        <p v-else>No events yet.</p>

        <button 
        type="button"
        class="mt-4 cursor-pointer rounded-lg border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-800 shadow-sm transition hover:bg-zinc-100" 
        @click="refreshEvents"
        >
        Refresh Events List
        </button>
    </Layout>
</template>