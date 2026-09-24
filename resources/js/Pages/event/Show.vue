<script setup>
import Layout from '../../Layout.vue';

defineProps({
    event: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Layout>
        <h1>{{ event.title }}</h1>
        <p><strong>Date:</strong> {{ event.start_date }}</p>
        <p>{{ event.description }}</p>
    </Layout>
</template>