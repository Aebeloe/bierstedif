<script setup lang="ts">
defineProps<{
    title: string;
    subtitle?: string;
}>();
</script>

<template>
    <div class="bg-bif-header px-4 py-12 text-white md:py-16">
        <div class="mx-auto max-w-5xl">
            <h1 class="text-2xl font-bold md:text-4xl">{{ title }}</h1>
            <p v-if="subtitle" class="mt-3 text-gray-300">{{ subtitle }}</p>
        </div>
    </div>
</template>
