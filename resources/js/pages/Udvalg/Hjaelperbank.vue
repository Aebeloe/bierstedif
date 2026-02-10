<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Heart, Users } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const boardMembers = [
    'Charlotte From',
    'Andreas Stoltze',
    'Laura Trolle',
    'Lisbeth Selvejer',
    'Rasmus Rosendahl',
    'Tatiana Larsen',
    'Jannie Svendsen',
    'Jakob Lund',
    'Henrik Skøtt',
];
</script>

<template>
    <Head title="Hjælperbank" />
    <PageHero title="Biersted IF's Hjælperbank" subtitle="Frivillige er fundamentet for vores forening" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <div class="flex items-center gap-3">
                    <Heart class="h-8 w-8 text-bif-accent" />
                    <h2 class="text-xl font-bold">Om Hjælperbanken</h2>
                </div>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Frivillige er uundværlige for at drive foreningen. Hjælperbanken opfører
                    frivillige opgaver med beskrivelser og tidskrav, og matcher derefter disse opgaver
                    med registrerede frivillige. Tilmelding sker via hjemmesiden, og frivillige kan blive
                    kontaktet i forbindelse med arrangementer.
                </p>
            </div>

            <div class="rounded-xl bg-bif-accent/10 p-6 md:p-8">
                <div class="flex items-center gap-3">
                    <Users class="h-8 w-8 text-bif-accent" />
                    <div>
                        <p class="text-3xl font-bold text-bif-accent">96</p>
                        <p class="text-sm text-bif-muted">aktive frivillige</p>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-bif-muted">
                    Bestyrelsen talte 96 aktive frivillige. Hvis frivillige tjente 150-200 kr/time
                    for gennemsnitligt 5 timers arbejde ugentligt over 40 uger årligt, ville foreningen
                    skylde cirka 2,9 millioner kroner årligt – det viser frivilliges enorme værdi.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Hjælper Bank Bestyrelse</h2>
                <div class="mt-4 grid gap-2 sm:grid-cols-2">
                    <div
                        v-for="member in boardMembers"
                        :key="member"
                        class="flex items-center gap-2 text-bif-muted"
                    >
                        <span class="h-2 w-2 rounded-full bg-bif-accent"></span>
                        {{ member }}
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfPoRJLEfit7oBjq3I2m1gIgB6KP5sG1NZtGshgNK0WTZv-dQ/viewform" target="_blank" rel="noopener" class="inline-block rounded-lg bg-bif-accent px-6 py-3 font-medium text-white transition hover:bg-bif-accent-dark">
                    Tilmeld Hjælperbanken
                </a>
            </div>
        </div>
    </div>
</template>
