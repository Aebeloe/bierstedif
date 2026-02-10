<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Building2, Users, Palette } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="TUEN" />
    <PageHero title="TUEN" subtitle="Udviklingsprojekt for kultur- og sportsfaciliteter i Biersted" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om TUEN-projektet</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    TUEN er et udviklingsprojekt, der sigter mod at udvide og optimere kultur- og sportsfaciliteterne
                    i Biersted. Projektet søger at gøre den eksisterende hal mere tilgængelig og synlig,
                    samtidig med at der opføres en ny bygning med fokus på sensorisk og motorisk udvikling.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <Building2 class="h-8 w-8 text-bif-accent" />
                    <h3 class="mt-4 font-semibold">ASF</h3>
                    <p class="mt-2 text-sm text-bif-muted">
                        Børn og unge med særlige behov. Biersted huser kommunens ASF-afdeling og børnehave,
                        vokset fra 7 til over 60 elever.
                    </p>
                </div>
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <Users class="h-8 w-8 text-bif-accent" />
                    <h3 class="mt-4 font-semibold">Idræt (BIF)</h3>
                    <p class="mt-2 text-sm text-bif-muted">
                        Sportsaktiviteter gennem den lokale idrætsforening med faciliteter til badminton,
                        hockey, springbræt, klatrevæg og scene.
                    </p>
                </div>
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <Palette class="h-8 w-8 text-bif-accent" />
                    <h3 class="mt-4 font-semibold">Kultur</h3>
                    <p class="mt-2 text-sm text-bif-muted">
                        Kulturelle aktiviteter for det bredere lokalsamfund med plads til foredrag,
                        bingo, koncerter og sociale arrangementer.
                    </p>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Fælles faciliteter</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Projektet kombinerer plads til idræt med fællesområder som café, massage, fitness
                    og virtual reality samt kulturelle faciliteter til foredrag, bingo og koncerter.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Konceptet er udviklet i samarbejde med LandLab via borgermøder. Kommunens strategi
                    fra 2017 "Ildsjæle gør forskellen" understøtter dette initiativ og støtter lokal
                    økonomisk udvikling og livskvalitetsforbedringer.
                </p>
            </div>
        </div>
    </div>
</template>
