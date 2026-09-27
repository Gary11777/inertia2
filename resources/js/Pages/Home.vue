<script setup>
import Layout from '../Layout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    articles: {
        type: Array,
        default: () => [],
    },
    events: {
        type: Array,
        default: () => [],
    },
});

const showEventsList = ref(false);

/** Client-side visit options for lazy `events` (see optional prop in routes/web.php). */
const loadEventsVisitOptions = {
    preserveState: true,
    preserveScroll: true,
    only: ['events'],
};

function openEventsList() {
    showEventsList.value = true;

    if (props.events.length === 0) {
        router.reload(loadEventsVisitOptions);
    }
}

function hideEventsList() {
    showEventsList.value = false;
}
</script>

<template>
    <Head>
        <title>Home Page</title>
        <meta name="description" content="Home page of Inertia2">
    </Head>

    <Layout>
        <h1 class="text-2xl font-bold tracking-tight">Inertia2 Home Page</h1>

        <div class="mt-6">
            <button
                type="button"
                class="cursor-pointer rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800"
                @click="openEventsList"
            >
                Show List of Events
            </button>

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
        </div>

        <p class="mt-10 text-base text-zinc-600">
            Latest notes and guides from the project.
        </p>

        <ul class="mt-8 space-y-8">
            <li
                v-for="article in articles"
                :key="article.id"
                class="rounded-xl border border-zinc-200 bg-zinc-50/80 p-6 transition hover:border-zinc-300 sm:p-8"
            >
                <h2 class="mt-2 text-xl font-semibold text-zinc-900">
                    {{ article.title }}
                </h2>
                <p class="mt-2 text-sm text-zinc-500">
                    Published on {{ article.published_at }}
                </p>
                <p class="mt-2 text-sm text-zinc-500">
                    By {{ article.author_name }} · {{ article.author_email }}
                </p>

                <p class="mt-5 whitespace-pre-line text-base leading-7 text-zinc-700">
                    {{ article.content }}
                </p>
            </li>
        </ul>
    </Layout>
</template>
