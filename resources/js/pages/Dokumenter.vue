<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ExternalLink } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Dokumenter" />
    <PageHero title="Dokumenter" subtitle="Referater og formularer" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl space-y-10">
            <section>
                <div class="mb-4 flex items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-bif-dark">Referater</h2>
                    <a href="https://drive.google.com/drive/folders/1YT4XgMb7ue3cWgOzM4F3kqvQwyO7jRo9" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-sm font-medium text-bif-accent hover:underline">
                        <ExternalLink class="h-4 w-4" /> Åbn i Drive
                    </a>
                </div>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <iframe
                        src="https://drive.google.com/embeddedfolderview?id=1YT4XgMb7ue3cWgOzM4F3kqvQwyO7jRo9#list"
                        class="h-[360px] w-full border-0 md:h-[600px]"
                        title="Referater"
                    />
                </div>
            </section>

            <section>
                <div class="mb-4 flex items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-bif-dark">Formularer</h2>
                    <a href="https://drive.google.com/drive/folders/1BiuNJRUZ-h6ON9KliNd7qDTiACbTXqDl" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-sm font-medium text-bif-accent hover:underline">
                        <ExternalLink class="h-4 w-4" /> Åbn i Drive
                    </a>
                </div>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <iframe
                        src="https://drive.google.com/embeddedfolderview?id=1BiuNJRUZ-h6ON9KliNd7qDTiACbTXqDl#list"
                        class="h-[360px] w-full border-0 md:h-[600px]"
                        title="Formularer"
                    />
                </div>
            </section>

            <section>
                <div class="mb-4 flex items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-bif-dark">Dokumenter</h2>
                    <a href="https://drive.google.com/drive/folders/1QsM8uXzMuLrNknWN6KxMbVKTXexe018G" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-sm font-medium text-bif-accent hover:underline">
                        <ExternalLink class="h-4 w-4" /> Åbn i Drive
                    </a>
                </div>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <iframe
                        src="https://drive.google.com/embeddedfolderview?id=1QsM8uXzMuLrNknWN6KxMbVKTXexe018G#list"
                        class="h-[360px] w-full border-0 md:h-[600px]"
                        title="Dokumenter"
                    />
                </div>
            </section>
        </div>
    </div>
</template>
