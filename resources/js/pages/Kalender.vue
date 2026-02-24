<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Kalender" />
    <PageHero title="Kalender" subtitle="Kommende begivenheder og aktiviteter" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl space-y-10">
            <div class="flex flex-col items-center rounded-xl bg-white p-12 text-center shadow-md">
                <p class="text-bif-muted">Kalenderen er midlertidigt utilgængelig.</p>
            </div>
        </div>
    </div>
</template>
