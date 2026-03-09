<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import ConventusIframe from '@/components/ConventusIframe.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

const props = defineProps<{ conventusUrl?: string }>();
</script>

<template>
    <Head title="Esport" />
    <PageHero title="Esport" subtitle="Tilmelding til esport i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Esport i Biersted IF</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Bliv en del af vores esport-afdeling! Vi tilbyder organiseret gaming og turneringer
                    for unge spillere.
                </p>
            </div>

            <ConventusIframe v-if="conventusUrl" :src="conventusUrl" class="mt-8 rounded-xl shadow-md" />
        </div>
    </div>
</template>
