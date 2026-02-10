<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Biersted Nyt" />
    <PageHero title="Biersted Nyt" subtitle="Nyheder fra Biersted IF og lokalområdet" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Biersted Nyt</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Biersted Nyt er foreningens nyhedsbrev, der holder dig opdateret om aktiviteter,
                    begivenheder og nyheder fra Biersted IF og lokalområdet.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Følg med på vores sociale medier for de seneste nyheder og opdateringer fra foreningen.
                </p>
            </div>
        </div>
    </div>
</template>
