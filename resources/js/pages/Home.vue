<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import { Calendar, Dumbbell, Info, Users } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const quickCards = [
    { title: 'Kalender', description: 'Se kommende begivenheder og aktiviteter', href: '/kalender', icon: Calendar },
    { title: 'Prøvetræning', description: 'Prøv en gratis træning i en af vores afdelinger', href: '/tilmeldinger/proevetraening', icon: Dumbbell },
    { title: 'Om Foreningen', description: 'Læs om Biersted IF og vores historie', href: '/om-foreningen', icon: Info },
    { title: 'Aktiviteter', description: 'Se alle vores sports- og fritidsaktiviteter', href: '/tilmeldinger/proevetraening', icon: Users },
];
</script>

<template>
    <Head title="Forside" />

    <!-- Hero -->
    <section class="relative flex items-center justify-center bg-bif-header px-4 py-20 text-white md:py-32">
        <img src="/cover.png" alt="" class="absolute inset-0 h-full w-full object-cover opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-br from-bif-header/80 via-bif-header/60 to-bif-accent/20"></div>
        <div class="relative z-10 mx-auto max-w-4xl text-center">
            <h1 class="text-3xl font-bold md:text-5xl lg:text-6xl">Velkommen til Biersted IF</h1>
            <p class="mt-4 text-lg text-gray-300 md:text-xl">
                Din lokale idrætsforening i Biersted med aktiviteter for hele familien
            </p>
            <div class="mt-8 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                <Link href="/tilmeldinger/proevetraening" class="rounded-lg bg-bif-accent px-6 py-3 font-medium text-white transition hover:bg-bif-accent-dark">
                    Prøv en gratis træning
                </Link>
                <Link href="/om-foreningen" class="rounded-lg border border-white/30 px-6 py-3 font-medium text-white transition hover:bg-white/10">
                    Læs mere om os
                </Link>
            </div>
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
                    class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <component :is="card.icon" class="h-8 w-8 text-bif-accent transition group-hover:scale-110" />
                    <h3 class="mt-4 font-semibold">{{ card.title }}</h3>
                    <p class="mt-2 text-sm text-bif-muted">{{ card.description }}</p>
                </Link>
            </div>
        </div>
    </section>
</template>
