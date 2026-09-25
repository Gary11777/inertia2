import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    title: (title) => (title ? `${title} - Inertia2` : 'Inertia2'),
});

// import { createApp } from 'vue';
// import ExampleComponent from './components/ExampleComponent.vue';

// createApp(ExampleComponent).mount('#app');
