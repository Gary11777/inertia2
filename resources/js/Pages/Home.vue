<script setup>
import Layout from '../Layout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Layout>
        <h1><b>Hello World!</b></h1>
        <ul>
            <li>
                <Link href="/events/1">Event 1</Link>
            </li>
            <li>
                <Link href="/events/2">Event 2</Link>
            </li>
        </ul>
    </Layout>
</template>
