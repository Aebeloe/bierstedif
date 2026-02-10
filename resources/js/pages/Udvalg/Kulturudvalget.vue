<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Mail, Phone } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const members = [
    'Marie-Louise Jensen',
    'Birgitte Sanden',
    'Birgitte Leding Skøtt',
];
</script>

<template>
    <Head title="Kulturudvalget" />
    <PageHero title="Kulturudvalget" subtitle="Kulturelle arrangementer i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Kulturudvalget</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Kulturudvalget arrangerer eller medarrangerer forskellige kulturelle initiativer
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
                    <div class="flex items-center gap-3">
                        <Mail class="h-5 w-5 text-bif-accent" />
                        <a href="mailto:birgitteleding@hotmail.com" class="text-bif-accent hover:underline">birgitteleding@hotmail.com</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <Phone class="h-5 w-5 text-bif-accent" />
                        <a href="tel:28773988" class="text-bif-accent hover:underline">28 77 39 88</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
