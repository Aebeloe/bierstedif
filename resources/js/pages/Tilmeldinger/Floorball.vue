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
    return `<!DOCTYPE html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<style>body{margin:0;font-family:system-ui,-apple-system,sans-serif;}</style></head>
<body>${props.conventusHtml}
<script>
function inv_dis(id){var el=document.getElementById(id);if(el){el.style.display=el.style.display==='none'?'':'none';requestAnimationFrame(function(){parent.postMessage({type:'conventus-resize',height:document.body.scrollHeight},'*');});}}
new ResizeObserver(function(){parent.postMessage({type:'conventus-resize',height:document.body.scrollHeight},'*');}).observe(document.body);
<\/script></body></html>`;
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
    <Head title="Floorball" />
    <PageHero title="Floorball" subtitle="Tilmelding til floorball i Biersted IF" bg="/floorballheader.jpg" bg-position="center 45%" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Floorball i Biersted IF</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Spil floorball i Bierstedhallen!
                </p>
            </div>

            <iframe
                v-if="srcdoc"
                :srcdoc="srcdoc"
                :style="{ height: iframeHeight + 'px', overflow: 'hidden' }"
                scrolling="no"
                class="mt-8 w-full rounded-xl border-0 bg-white shadow-md"
                sandbox="allow-scripts allow-popups allow-forms allow-modals"
            />
        </div>
    </div>
</template>
