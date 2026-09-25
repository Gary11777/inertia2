<script setup>
import Layout from '../Layout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Layout>
        <h1><b>Hello World!</b></h1>
        <p>
            <Link href="/events">List of Events</Link>
        </p>
    </Layout>
</template>
