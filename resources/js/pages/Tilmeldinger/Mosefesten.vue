<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import ShiftSignup from '@/components/ShiftSignup.vue';
import { Head } from '@inertiajs/vue3';
import type { PublicShift } from '@/types/shift';

defineOptions({ layout: MainLayout });

const props = defineProps<{ shifts: PublicShift[] }>();
</script>

<template>
    <Head title="Mosefesten - Vagttilmelding" />
    <PageHero title="Mosefesten" subtitle="Tilmeld dig som frivillig" bg="/mosefestheader.jpeg" :bgContain="true" />

    <ShiftSignup :shifts="props.shifts" claim-url="/tilmeldinger/mosefesten" footer="Uden frivillige, ingen Mosefest">
        Mosefesten er byens fælles fest, og som frivillig er du med til at skabe nogle gode dage for
        både børn og voksne. Vælg den opgave og det tidspunkt der passer dig.
    </ShiftSignup>
</template>
