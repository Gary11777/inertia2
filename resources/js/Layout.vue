<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const activeNavClass =
    'rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white';
const inactiveNavClass =
    'rounded-lg px-3 py-2 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900';

function navClass(...components) {
    return components.includes(page.component) ? activeNavClass : inactiveNavClass;
}
</script>

<template>
    <div class="flex min-h-screen flex-col bg-zinc-50 text-zinc-900 antialiased">
        <header class="sticky top-0 z-50 border-b border-zinc-200/80 bg-white/80 backdrop-blur-md">
            <div class="mx-auto flex h-14 max-w-5xl items-center justify-between gap-6 px-4 sm:px-6">
                <Link href="/" class="text-sm font-semibold tracking-tight text-zinc-900">
                    Inertia2
                </Link>
                <nav class="flex flex-wrap items-center gap-1 sm:gap-2">
                    <Link href="/" :class="navClass('Home')" view-transition>Home</Link>
                    <Link href="/about" :class="navClass('About')" view-transition>About</Link>
                    <Link href="/contact" :class="navClass('Contact')" view-transition>Contact</Link>
                    <Link href="/events" :class="navClass('event/Index', 'event/Show')" view-transition>Events</Link>
                </nav>
            </div>
        </header>

        <main class="mx-auto w-full max-w-5xl flex-1 px-4 py-8 sm:px-6 sm:py-10">
            <article class="rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm sm:p-8">
                <slot />
            </article>
        </main>

        <footer class="border-t border-zinc-200/80 bg-white">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4 text-sm text-zinc-500 sm:px-6">
                <p>© 2026</p>
            </div>
        </footer>
    </div>
</template>