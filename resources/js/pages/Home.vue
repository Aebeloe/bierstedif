<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import { Calendar, Dumbbell, Info, Users } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const quickCards = [
    { title: 'Kalender', description: 'Se kommende begivenheder og aktiviteter', href: '/kalender', icon: Calendar, bg: '/kalender.jpg' },
    { title: 'Prøvetræning', description: 'Prøv en gratis træning i en af vores afdelinger', href: '/tilmeldinger/proevetraening', icon: Dumbbell, bg: '/prøvetræning.jpg' },
    { title: 'Om Foreningen', description: 'Læs om Biersted IF og vores historie', href: '/om-foreningen', icon: Info, bg: '/omforeningen.jpg' },
    { title: 'Aktiviteter', description: 'Se alle vores sports- og fritidsaktiviteter', href: '/kontakt', icon: Users, bg: '/aktiviteter.jpg' },
];
</script>

<template>
    <Head title="Forside" />

    <!-- Hero -->
    <section class="bg-bif-header">
        <img src="/cover.png" alt="" class="w-full" />
        <div class="flex items-center justify-center gap-4 px-4 py-6">
            <Link href="/tilmeldinger/proevetraening" class="rounded-lg bg-bif-accent px-6 py-3 font-medium text-white transition hover:bg-bif-accent-dark">
                Prøv en gratis træning
            </Link>
            <Link href="/om-foreningen" class="rounded-lg border border-white/30 px-6 py-3 font-medium text-white transition hover:bg-white/10">
                Læs mere om os
            </Link>
        </div>
    </section>

    <!-- Velkomstvært -->
    <section class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl">
            <div class="overflow-hidden rounded-xl bg-white shadow-md md:flex">
                <div class="flex items-center justify-center bg-bif-accent/10 p-6 md:w-1/3 md:p-8">
                    <div class="mx-auto h-48 w-48 overflow-hidden rounded-full bg-bif-accent/20 md:h-56 md:w-56">
                        <img src="/velkomstvaert.jpeg" alt="René Diget" class="h-full w-full object-cover" loading="eager" />
                    </div>
                </div>
                <div class="p-6 md:w-2/3 md:p-8">
                    <p class="text-xs font-medium uppercase tracking-wider text-bif-accent">Foreningsbestyrer</p>
                    <h2 class="mt-2 text-xl font-bold md:text-2xl">René Diget</h2>
                    <p class="mt-1 text-sm text-bif-muted">Foreningsbestyrer | Biersted IF</p>
                    <p class="mt-3 text-bif-muted">
                        Er du ny i Biersted eller bare nysgerrig efter at høre mere om vores forening?
                        Så er du altid velkommen til at kontakte vores velkomstvært René, som kan fortælle
                        dig alt om mulighederne i Biersted IF.
                    </p>
                    <div class="mt-4 space-y-2 text-sm">
                        <p><span class="text-bif-muted">Telefon:</span> <a href="tel:+4561279081" class="text-bif-accent hover:underline">+45 61 27 90 81</a></p>
                        <p><span class="text-bif-muted">Email:</span> <a href="mailto:Bierstedif@bierstedif.dk" class="text-bif-accent hover:underline">Bierstedif@bierstedif.dk</a></p>
                        <p><span class="text-bif-muted">Web:</span> <a href="https://www.bierstedif.dk" class="text-bif-accent hover:underline">www.bierstedif.dk</a></p>
                    </div>
                    <Link href="/tilmeldinger/proevetraening" class="mt-6 inline-block rounded-lg bg-bif-accent px-5 py-2.5 text-sm font-medium text-white transition hover:bg-bif-accent-dark">
                        Deltag i en gratis prøvetræning
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick access cards -->
    <section class="px-4 pb-16">
        <div class="mx-auto max-w-5xl">
            <h2 class="mb-8 text-center text-xl font-bold md:text-2xl">Genveje</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <Link
                    v-for="card in quickCards"
                    :key="card.title"
                    :href="card.href"
                    class="group relative overflow-hidden rounded-xl p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <img :src="card.bg" :alt="card.title" class="absolute inset-0 h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-black/50 transition group-hover:bg-black/40"></div>
                    <div class="relative">
                        <component :is="card.icon" class="h-8 w-8 text-white transition group-hover:scale-110" />
                        <h3 class="mt-4 font-semibold text-white">{{ card.title }}</h3>
                        <p class="mt-2 text-sm text-white/80">{{ card.description }}</p>
                    </div>
                </Link>
            </div>
        </div>
    </section>
</template>
