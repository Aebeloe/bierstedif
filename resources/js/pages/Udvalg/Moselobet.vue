<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Moseløbet" />
    <PageHero title="Moseløbet" subtitle="Det årlige motionsløb i Biersted" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Moseløbet</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Moseløbet er et årligt motionsløb arrangeret af Biersted IF. Løbet samler deltagere
                    fra hele lokalområdet og er en fantastisk mulighed for at dyrke motion i naturskønne omgivelser
                    omkring Biersted.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Moseløbet afholdes Grundlovsdag d. 5. juni 2026.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Hold øje med vores <a href="https://www.facebook.com/groups/344109562373511?locale=da_DK" target="_blank" rel="noopener" class="text-bif-accent hover:underline">Facebook-side</a> for information om næste års Moseløb, herunder tilmelding,
                    ruter og praktisk information.
                </p>
            </div>
        </div>
    </div>
</template>
