<script setup>
import Layout from '../Layout.vue';
import { Head } from '@inertiajs/vue3';

const contacts = [
    {
        id: 1,
        name: 'Alex Morgan',
        role: 'Community lead',
        email: 'alex.morgan@example.com',
        phone: '+1 (555) 010-2244',
        city: 'Portland, OR',
    },
    {
        id: 2,
        name: 'Jordan Lee',
        role: 'Events coordinator',
        email: 'jordan.lee@example.com',
        phone: '+1 (555) 010-8891',
        city: 'Austin, TX',
    },
    {
        id: 3,
        name: 'Sam Rivera',
        role: 'Support',
        email: 'sam.rivera@example.com',
        phone: '+1 (555) 010-4410',
        city: 'Chicago, IL',
    },
    {
        id: 4,
        name: 'Taylor Brooks',
        role: 'Partnerships',
        email: 'taylor.brooks@example.com',
        phone: '+1 (555) 010-7732',
        city: 'Denver, CO',
    },
];
</script>

<template>
    <Head>
        <title>Contact</title>
        <meta name="description" content="Contact Inertia2">
    </Head>

    <Layout>
        <h1 class="text-2xl font-bold tracking-tight">Contact</h1>

        <p class="mt-2 text-zinc-600">
            Sample team contacts for demo purposes—reach out anytime.
        </p>

        <ul class="mt-8 grid gap-4 sm:grid-cols-2">
            <li
                v-for="person in contacts"
                :key="person.id"
                class="rounded-xl border border-zinc-200 bg-zinc-50/80 p-5"
            >
                <h2 class="text-base font-semibold text-zinc-900">
                    {{ person.name }}
                </h2>
                <p class="text-sm text-zinc-500">{{ person.role }}</p>
                <dl class="mt-4 space-y-2 text-sm">
                    <div>
                        <dt class="sr-only">Email</dt>
                        <dd>
                            <a
                                :href="`mailto:${person.email}`"
                                class="font-medium text-zinc-800 underline decoration-zinc-300 underline-offset-2 hover:decoration-zinc-600"
                            >
                                {{ person.email }}
                            </a>
                        </dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-zinc-500">Phone</dt>
                        <dd class="text-zinc-800">{{ person.phone }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-zinc-500">Location</dt>
                        <dd class="text-zinc-800">{{ person.city }}</dd>
                    </div>
                </dl>
            </li>
        </ul>
    </Layout>
</template>
