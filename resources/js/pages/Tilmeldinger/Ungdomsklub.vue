<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ExternalLink } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Ungdomsklub" />
    <PageHero title="Ungdomsklub" subtitle="Tilmelding til ungdomsklubben i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Ungdomsklub i Biersted IF</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Vores ungdomsklub tilbyder et trygt og sjovt miljø for unge i Biersted.
                    Tilmeld dig som nyt medlem eller log ind som eksisterende medlem.
                </p>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="https://www.conventus.dk/bierstedif" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-accent px-5 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark">
                        Nyt Medlem <ExternalLink class="h-4 w-4" />
                    </a>
                    <a href="https://www.conventus.dk/bierstedif" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-btn px-5 py-2.5 font-medium text-white transition hover:bg-bif-btn-hover">
                        Login <ExternalLink class="h-4 w-4" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
