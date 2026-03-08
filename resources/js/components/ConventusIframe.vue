<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';

defineProps<{ src: string }>();

const height = ref(400);

function onMessage(e: MessageEvent) {
    if (e.data?.type === 'conventus-resize' && typeof e.data.height === 'number') {
        height.value = e.data.height;
    }
}

onMounted(() => window.addEventListener('message', onMessage));
onBeforeUnmount(() => window.removeEventListener('message', onMessage));
</script>

<template>
    <iframe
        :src="src"
        :style="{ height: height + 'px', overflow: 'hidden' }"
        scrolling="no"
        class="w-full border-0 bg-white"
    />
</template>
