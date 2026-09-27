<script setup>
import Layout from '../Layout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    events: {
        type: Array,
        default: () => [],
    },
});

const articles = [
    {
        id: 1,
        title: 'Welcome to Inertia2',
        date: 'Mar 12, 2026',
        paragraphs: [
            'Inertia2 is a learning playground where Laravel stays in charge of routing, validation, and data, while Vue delivers a responsive interface without building a separate JSON API for every screen.',
            'If you have used traditional Blade templates, the mental model is familiar: each URL returns a full document. The difference is that Inertia swaps page components in the browser instead of reloading the entire layout on every click.',
            'That middle ground matters for product teams. You keep server-side authorization and form handling, yet users still get quick transitions and shared layouts that feel like a single-page application.',
            'This home page is intentionally simple. It introduces the project, surfaces a few longer articles, and includes a button that lazy-loads event data only when you ask for it.',
            'Take a moment to click through the navigation bar. Notice how the header and footer persist while the main content changes. That persistence is the layout component wrapping each page.',
            'Optional props on the server side pair with partial visits on the client. Together they let you defer expensive queries until the user expresses interest, which is a pattern you will reuse in real apps.',
            'Use the articles below as reading material while you experiment. When you are ready, open the events list or visit the dedicated events index to see list and detail pages wired end to end.',
        ],
    },
    {
        id: 2,
        title: 'Lazy-loaded event previews',
        date: 'Mar 18, 2026',
        paragraphs: [
            'The first time you land on the home page, the server may omit the events collection entirely. That keeps the initial response light when you only wanted to read the welcome content.',
            'When you click “Show List of Events,” the page reveals a panel and checks whether event rows are already available in memory. If the array is empty, the client issues a targeted Inertia GET back to the same URL.',
            'That visit uses preserveState and preserveScroll so your expanded panel stays open and the viewport does not jump. The only prop requested is events, which triggers the optional callback on the server.',
            'Optional props in Laravel wrap a closure that runs only when the client includes the key in the partial reload. It is an explicit contract: no accidental N+1 loading on every home page view.',
            'From a networking perspective, you still make one round trip, but the payload stays focused. Inertia merges the fresh props into the existing page object, and Vue re-renders the list automatically.',
            'If you add records in the database and click the button again, you will see updated titles without a full refresh, provided the client already holds events and you only toggled visibility.',
            'Try combining this pattern with authorization later: optional props can return different slices of data depending on the authenticated user, still without exposing a public REST surface.',
        ],
    },
    {
        id: 3,
        title: 'What to explore next',
        date: 'Mar 22, 2026',
        paragraphs: [
            'Start with the events index route, which lists every record with links to individual show pages. Compare how that flow feels versus the inline list on the home page.',
            'On the index, use the refresh control to reload only the events prop. That demonstrates router.reload with preserveState, a handy tool when a background job might change data.',
            'Open an event detail page and note the URL structure. Route model binding resolves the record on the server, and Inertia passes a shaped array to the Vue page as props.',
            'Visit About for longer background on why the stack was chosen, and Contact for sample team cards. Neither page needs a database table for this demo, but the navigation treats them equally.',
            'Pay attention to active navigation styling in the layout. It keys off the current URL, so nested paths such as event details still highlight the Events entry when you use prefix matching.',
            'When you read the Inertia documentation on manual visits, map each method to something in this repo: router.get on home, router.reload on the index, and Link components everywhere else.',
            'From here you might add forms, flash messages, or pagination—all still within Inertia’s request cycle. This project stays small on purpose so each addition remains easy to study.',
        ],
    },
];

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
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">
                    {{ article.date }}
                </p>
                <h2 class="mt-2 text-xl font-semibold text-zinc-900">
                    {{ article.title }}
                </h2>
                <div class="mt-5 space-y-4">
                    <p
                        v-for="(paragraph, index) in article.paragraphs"
                        :key="index"
                        class="text-base leading-7 text-zinc-700"
                    >
                        {{ paragraph }}
                    </p>
                </div>
            </li>
        </ul>
    </Layout>
</template>
