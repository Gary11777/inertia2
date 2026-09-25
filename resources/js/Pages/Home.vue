<script setup>
import Layout from '../Layout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    events: {
        type: Array,
        default: () => [],
    },
});

const showEventsList = ref(false);

function openEventsList() {
    showEventsList.value = true;
    
    if (props.events.length === 0) {
        router.get('/', {}, {
            preserveState: true,
            preserveScroll: true,
            only: ['events'],
        });
    }
}

function hideEventsList() {
    showEventsList.value = false;
}
</script>

<template>
    <Layout>
        <h1><b>Inertia2 Home Page</b></h1>

        <p>
            <!-- Looks like a link; stays on Home -->
            <button
                type="button"
                class="cursor-pointer rounded-lg bg-gray-700 px-4 py-2 text-sm font-medium text-gray-50 shadow-sm transition hover:bg-gray-600 active:bg-gray-800"
                @click="openEventsList"
            >
                Show List of Events
            </button>
        </p>

        <div
            v-if="showEventsList"
            class="mt-6 rounded-xl border border-zinc-200 bg-zinc-50 p-4"
        >
            <h2 class="mb-3 text-lg font-semibold">Events</h2>

            <ul v-if="events.length" class="space-y-2">
                <li v-for="event in events" :key="event.id">
                    {{ event.id }} — {{ event.title }} — {{ event.start_date }}
                    <Link :href="`/events/${event.id}`" class="ml-2 underline">
                        View
                    </Link>
                </li>
            </ul>

            <p v-else class="text-zinc-500">No events yet.</p>

            <button
                type="button"
                class="mt-4 cursor-pointer rounded-lg border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-800 shadow-sm transition hover:bg-zinc-100"
                @click="hideEventsList"
            >
                Hide Events List
            </button>
        </div>
    </Layout>
</template>
