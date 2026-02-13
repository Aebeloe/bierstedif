<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineOptions({ layout: MainLayout });

onMounted(() => {
    const w = window as any;
    if (document.getElementById('mw')) {
        w.mw('init', 'MW-d9M2hN7b');
        return;
    }
    w['motivu-widget'] = 'mw';
    w.mw = w.mw || function (...args: any[]) {
        (w.mw.q = w.mw.q || []).push(args);
    };
    const script = document.createElement('script');
    script.id = 'mw';
    script.src = 'https://assets.motivu.dk/js/widget.js';
    script.async = true;
    const first = document.getElementsByTagName('script')[0];
    first.parentNode!.insertBefore(script, first);
    w.mw('init', 'MW-d9M2hN7b');
});
</script>

<template>
    <Head title="Prøvetræning" />
    <PageHero title="Prøvetræning" subtitle="Prøv en gratis træning i en af vores afdelinger" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <div id="motivu"></div>
            </div>
        </div>
    </div>
</template>
