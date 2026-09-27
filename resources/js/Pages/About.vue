<script setup>
import Layout from '../Layout.vue';
import { Head } from '@inertiajs/vue3';

const articles = [
    {
        id: 1,
        title: 'Why we built Inertia2',
        date: 'Feb 8, 2026',
        paragraphs: [
            'Large starter kits are excellent for production, but they can hide the mechanics you are trying to learn. We wanted a repository small enough to read in an afternoon yet realistic enough to mimic day-to-day Laravel work.',
            'Inertia sits between classic multi-page applications and client-heavy SPAs. Choosing it for this demo lets us practice partial reloads, shared layouts, and Vue pages without maintaining duplicate validation rules in two languages.',
            'Every feature in the repo ties back to a teaching goal: optional props, manual router visits, route model binding, and consistent Tailwind styling across screens.',
            'We deliberately avoided admin dashboards, websockets, and billing flows so the cognitive load stays low. You can always add complexity once the core request cycle feels obvious.',
            'Documentation from the Inertia and Laravel teams remains the source of truth. This project is a companion sandbox where you can break things locally and compare behavior with the official guides.',
            'Contributors can treat the articles on these pages as narrative tests: if a paragraph describes behavior that no longer matches the code, the docs drifted and should be updated.',
            'Long term, the hope is that you copy patterns—not the prose—into your own applications, adapting optional props and reload strategies to your domain models.',
        ],
    },
    {
        id: 2,
        title: 'Stack at a glance',
        date: 'Feb 14, 2026',
        paragraphs: [
            'PHP 8 and Laravel provide routing, controllers, Eloquent models, and the service container. Nothing in the frontend bypasses those layers for reads or writes in this demo.',
            'Vue 3 with script setup keeps page components terse. Each file under the Pages directory maps directly to a string passed to Inertia::render on the server.',
            'Vite bundles assets during development with hot module replacement, which means edits to Vue files reflect quickly while Herd serves the PHP application.',
            'Tailwind utility classes define the visual system: zinc neutrals, rounded cards, sticky header blur, and responsive spacing without maintaining a large custom CSS file.',
            'SQLite backs the events table locally, which removes the need for a separate database service while you experiment on a laptop.',
            'The Inertia Vite plugin resolves page components and aligns version hashing so deployments can force clients to refresh stale JavaScript when you ship changes.',
            'Together these choices mirror many greenfield Laravel projects in 2026: monolith first, progressive enhancement, and JavaScript focused on UI rather than owning all business rules.',
        ],
    },
    {
        id: 3,
        title: 'Learning goals',
        date: 'Feb 20, 2026',
        paragraphs: [
            'First, recognize the shape of an Inertia response: a JSON document describing the component name and serializable props, not an HTML string.',
            'Second, compare navigation with Link components versus imperative router.get calls. Links remain the default; manual visits appear when you need conditional logic or partial data.',
            'Third, study how preserveState and only interact. They are the knobs that prevent UI flicker when you fetch additional props or refresh lists in place.',
            'Fourth, trace a full CRUD path mentally even though this repo only implements read routes today. Imagine where form posts would land and how validation errors would return as props.',
            'Fifth, observe layout composition: the shell lives in Layout.vue while each page supplies the inner article content through the default slot.',
            'Sixth, experiment with active navigation rules, whether you match URLs or component names, and decide which approach fits nested sections in your own product.',
            'Seventh, keep browser devtools open: watch X-Inertia headers, status codes on failed visits, and console errors when a page component name does not resolve.',
        ],
    },
    {
        id: 4,
        title: 'Events module',
        date: 'Mar 1, 2026',
        paragraphs: [
            'Events are the primary domain entity in the sandbox. A migration defines title, schedule, and description fields, and a seeder can populate sample rows for list views.',
            'The index action queries a minimal column set ordered by primary key, which keeps payloads small when Inertia serializes collections to the frontend.',
            'The show action uses implicit route model binding so invalid IDs become 404 responses before Vue ever mounts, matching standard Laravel conventions.',
            'Named routes events.index and events.show enable future links from emails or tests without hard-coding paths in multiple languages.',
            'The home page optional prop reuses the same query logic in spirit, but only when the client requests the events key during a partial visit.',
            'A refresh button on the index page calls router.reload to pull fresh rows after you mutate data in tinker or another terminal session.',
            'Extending the module might add create and edit forms, policy gates, or filters driven by query strings—each feature reinforcing the same Inertia request cycle you see today.',
        ],
    },
];
</script>

<template>
    <Head title="About" />

    <Layout>
        <h1 class="text-2xl font-bold tracking-tight">About</h1>

        <p class="mt-2 max-w-2xl text-base text-zinc-600">
            Background articles about this demo project and how the pieces fit together.
        </p>

        <ul class="mt-8 space-y-8">
            <li
                v-for="article in articles"
                :key="article.id"
                class="rounded-xl border border-zinc-200 bg-zinc-50/80 p-6 sm:p-8"
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
