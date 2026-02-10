<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Dumbbell } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Prøvetræning" />
    <PageHero title="Prøvetræning" subtitle="Prøv en gratis træning i en af vores afdelinger" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <div class="flex items-center gap-3">
                    <Dumbbell class="h-8 w-8 text-bif-accent" />
                    <h2 class="text-xl font-bold">Gratis prøvetræning</h2>
                </div>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Er du nysgerrig efter at prøve en af vores sportsgrene? Hos Biersted IF er du altid velkommen
                    til at deltage i en gratis prøvetræning, så du kan finde ud af, om det er noget for dig.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Kontakt os for at aftale en prøvetræning i den afdeling, du er interesseret i. Vi glæder os til
                    at se dig!
                </p>
                <div class="mt-6">
                    <a href="tel:61279081" class="inline-block rounded-lg bg-bif-accent px-5 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark">
                        Ring til os: 61 27 90 81
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
