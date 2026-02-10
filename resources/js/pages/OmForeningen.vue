<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Om Foreningen" />
    <PageHero title="Om Foreningen" subtitle="Læs om Biersted IF og vores historie" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Vores historie</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Biersted IF er en lokal idrætsforening beliggende i Biersted, en hyggelig landsby nord for Aalborg.
                    Foreningen er hjemsted for en række sports- og fritidsaktiviteter, der samler mennesker i alle aldre
                    fra lokalområdet.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Vores faciliteter er centreret omkring Bierstedhallen, som danner rammen om alt fra badminton og
                    gymnastik til håndbold og fodbold. Vi er stolte af at kunne tilbyde et bredt udvalg af aktiviteter,
                    så der er noget for enhver smag og alle aldersgrupper.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Vores mission</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    I Biersted IF arbejder vi for at skabe et stærkt fællesskab gennem idræt og kultur. Vi tror på,
                    at motion og samvær er fundamentet for et godt liv, og vi stræber efter at gøre det nemt og
                    tilgængeligt for alle at deltage i vores aktiviteter.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Vi drives af dedikerede frivillige, der lægger utallige timer i at sikre, at foreningen fungerer
                    optimalt. Uden vores frivillige ville Biersted IF ikke eksistere, og vi er dybt taknemmelige for
                    deres indsats.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Aktiviteter</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Vi tilbyder en bred vifte af sportsaktiviteter, herunder:
                </p>
                <ul class="mt-4 list-inside list-disc space-y-2 text-bif-muted">
                    <li>Badminton</li>
                    <li>Fodbold</li>
                    <li>Gymnastik</li>
                    <li>Håndbold</li>
                    <li>Esport</li>
                    <li>Ungdomsklub</li>
                </ul>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Derudover arrangerer vi løbende kulturelle arrangementer, foredrag og sociale sammenkomster
                    gennem vores kulturudvalg.
                </p>
            </div>
        </div>
    </div>
</template>
