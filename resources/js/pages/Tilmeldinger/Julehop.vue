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
    <Head title="Julehop - Vagttilmelding" />
    <PageHero title="Julehop" subtitle="Tilmeld dig som frivillig" />

    <ShiftSignup :shifts="props.shifts" claim-url="/tilmeldinger/julehop" footer="Uden frivillige, intet Julehop">
        Som frivillig til Julehop er du med til at skabe en hyggelig dag for både børn og voksne.
        Vælg den opgave og det tidspunkt der passer dig.
    </ShiftSignup>
</template>
