<script setup>
import Layout from '../../Layout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    event: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head>
        <title>Event Details</title>
        <meta name="description" :content="event.description">
    </Head>

    <Layout>
        <h1>{{ event.title }}</h1>
        <p><strong>Date:</strong> {{ event.start_date }}</p>
        <p>{{ event.description }}</p>
    </Layout>
</template>