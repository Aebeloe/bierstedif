<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

defineProps<{
    sponsors: { image: string; name: string; url: string | null }[];
}>();
</script>

<template>
    <Head title="Sponsorer" />
    <PageHero title="Sponsorer" subtitle="Støt vores sponsorer – de støtter os" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <component
                    v-for="sponsor in sponsors"
                    :key="sponsor.name"
                    :is="sponsor.url ? 'a' : 'div'"
                    :href="sponsor.url || undefined"
                    :target="sponsor.url ? '_blank' : undefined"
                    :rel="sponsor.url ? 'noopener' : undefined"
                    class="flex items-center justify-center rounded-xl bg-white p-6 shadow-md transition hover:shadow-lg"
                >
                    <img
                        :src="sponsor.image"
                        :alt="sponsor.name"
                        class="h-24 w-full object-contain"
                    />
                </component>
            </div>
        </div>
    </div>
</template>
