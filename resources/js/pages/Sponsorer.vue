<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

const sponsors = [
    { name: 'Bangbyg', initials: 'BB' },
    { name: 'Brugsen', initials: 'BR' },
    { name: 'Grønborg El', initials: 'GE' },
    { name: 'Pentia', initials: 'PE' },
];
</script>

<template>
    <Head title="Sponsorer" />
    <PageHero title="Sponsorer" subtitle="Støt vores sponsorer – de støtter os" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="sponsor in sponsors"
                    :key="sponsor.name"
                    class="flex flex-col items-center rounded-xl bg-white p-8 shadow-md transition hover:shadow-lg"
                >
                    <div class="flex h-24 w-24 items-center justify-center rounded-full bg-bif-bg text-2xl font-bold text-bif-accent">
                        {{ sponsor.initials }}
                    </div>
                    <p class="mt-4 text-lg font-semibold">{{ sponsor.name }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
