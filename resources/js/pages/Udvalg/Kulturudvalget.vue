<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Mail, Phone } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const members = [
    'Michael From',
    'René Diget',
];
</script>

<template>
    <Head title="Eventudvalget" />
    <PageHero title="Eventudvalget" subtitle="Kulturelle arrangementer i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Eventudvalget</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Eventudvalget arrangerer eller medarrangerer forskellige kulturelle initiativer
                    inden for Biersted idrætsforening. Eksempler inkluderer sangaftener, foredrag,
                    vin- og tapassmagning og stand-up.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Har du en idé til et kulturelt arrangement? Så er du velkommen til at kontakte
                    udvalgets medlemmer.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Medlemmer</h2>
                <ul class="mt-4 space-y-2">
                    <li v-for="member in members" :key="member" class="flex items-center gap-2 text-bif-muted">
                        <span class="h-2 w-2 rounded-full bg-bif-accent"></span>
                        {{ member }}
                    </li>
                </ul>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Kontakt</h2>
                <div class="mt-4 space-y-3">
                    <p class="font-medium text-bif-muted">Michael From</p>
                    <div class="flex items-center gap-3">
                        <Mail class="h-5 w-5 text-bif-accent" />
                        <a href="mailto:mfeldbk@gmail.com" class="text-bif-accent hover:underline">mfeldbk@gmail.com</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <Phone class="h-5 w-5 text-bif-accent" />
                        <a href="tel:22836996" class="text-bif-accent hover:underline">22 83 69 96</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
