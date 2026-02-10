<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Calendar } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Kalender" />
    <PageHero title="Kalender" subtitle="Kommende begivenheder og aktiviteter" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="flex flex-col items-center rounded-xl bg-white p-12 text-center shadow-md">
                <Calendar class="h-16 w-16 text-bif-accent" />
                <h2 class="mt-6 text-xl font-bold">Kalenderen kommer snart</h2>
                <p class="mt-3 max-w-md text-bif-muted">
                    Vi arbejder på at få vores kalender op at køre. Følg med på vores Facebook-side
                    for de seneste opdateringer om begivenheder og aktiviteter.
                </p>
                <a
                    href="https://www.facebook.com/bierstedif"
                    target="_blank"
                    rel="noopener"
                    class="mt-6 rounded-lg bg-bif-accent px-5 py-2.5 text-sm font-medium text-white transition hover:bg-bif-accent-dark"
                >
                    Følg os på Facebook
                </a>
            </div>
        </div>
    </div>
</template>
