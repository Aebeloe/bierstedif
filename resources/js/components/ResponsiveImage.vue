<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(defineProps<{
    src: string;
    name: string;
    widths: number[];
    sizes?: string;
    alt: string;
    loading?: 'lazy' | 'eager';
}>(), {
    sizes: '100vw',
    loading: 'lazy',
});

const srcset = computed(() => props.widths.map((w) => `/img/${props.name}-${w}.webp ${w}w`).join(', '));
</script>

<template>
    <img :src="src" :srcset="srcset" :sizes="sizes" :alt="alt" :loading="loading" />
</template>
