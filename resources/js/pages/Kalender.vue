<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

defineOptions({ layout: MainLayout });

const props = defineProps<{ conventusHtml?: string }>();

const iframeHeight = ref(400);

const srcdoc = computed(() => {
    if (!props.conventusHtml) return '';
    return props.conventusHtml.replace(
        '</body>',
        `<script>
new ResizeObserver(function(){parent.postMessage({type:'conventus-resize',height:document.body.scrollHeight},'*');}).observe(document.body);
<\/script></body>`
    );
});

function onMessage(e: MessageEvent) {
    if (e.data?.type === 'conventus-resize') {
        iframeHeight.value = e.data.height;
    }
}

onMounted(() => window.addEventListener('message', onMessage));
onBeforeUnmount(() => window.removeEventListener('message', onMessage));
</script>

<template>
    <Head title="Kalender" />
    <PageHero title="Kalender" subtitle="Kommende begivenheder og aktiviteter" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl">
            <div v-if="conventusHtml" class="overflow-hidden rounded-xl bg-white shadow-md">
                <iframe
                    :srcdoc="srcdoc"
                    :style="{ height: iframeHeight + 'px' }"
                    class="w-full border-0"
                    sandbox="allow-same-origin allow-scripts allow-popups"
                />
            </div>
            <div v-else class="flex flex-col items-center rounded-xl bg-white p-12 text-center shadow-md">
                <p class="text-bif-muted">Kalenderen kunne ikke indlæses. Prøv igen senere.</p>
            </div>
        </div>
    </div>
</template>
