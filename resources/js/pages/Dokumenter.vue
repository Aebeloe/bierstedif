<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Dokumenter" />
    <PageHero title="Dokumenter" subtitle="Referater og formularer" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl space-y-10">
            <section>
                <h2 class="mb-4 text-2xl font-bold text-bif-dark">Referater</h2>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <iframe
                        src="https://drive.google.com/embeddedfolderview?id=1YT4XgMb7ue3cWgOzM4F3kqvQwyO7jRo9#list"
                        class="h-[600px] w-full border-0"
                        title="Referater"
                    />
                </div>
            </section>

            <section>
                <h2 class="mb-4 text-2xl font-bold text-bif-dark">Formularer</h2>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <iframe
                        src="https://drive.google.com/embeddedfolderview?id=1BiuNJRUZ-h6ON9KliNd7qDTiACbTXqDl#list"
                        class="h-[600px] w-full border-0"
                        title="Formularer"
                    />
                </div>
            </section>
        </div>
    </div>
</template>
