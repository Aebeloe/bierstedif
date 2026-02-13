<script setup lang="ts">
const props = withDefaults(defineProps<{
    title: string;
    subtitle?: string;
    bg?: string;
    bgPosition?: string;
}>(), {
    bgPosition: 'center 30%',
});
</script>

<template>
    <div class="relative bg-bif-header px-4 py-12 text-white md:py-16">
        <img v-if="bg" :src="bg" :alt="title" class="absolute inset-0 h-full w-full object-cover" :style="{ objectPosition: props.bgPosition }" />
        <div v-if="bg" class="absolute inset-0 bg-black/50"></div>
        <div class="relative mx-auto max-w-5xl">
            <h1 class="text-2xl font-bold md:text-4xl">{{ title }}</h1>
            <p v-if="subtitle" class="mt-3 text-gray-300">{{ subtitle }}</p>
        </div>
    </div>
</template>
