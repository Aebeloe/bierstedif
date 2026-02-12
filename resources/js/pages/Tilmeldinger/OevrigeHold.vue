<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ExternalLink } from 'lucide-vue-next';
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
    <Head title="Øvrige Hold" />
    <PageHero title="Øvrige Hold" subtitle="Tilmelding til øvrige hold i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Øvrige Hold</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Ud over vores hovedaktiviteter tilbyder vi også andre hold og aktiviteter.
                    Tilmeld dig som nyt medlem eller log ind som eksisterende medlem.
                </p>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="https://www.conventus.dk/dataudv/www/new_tilmelding.php?foreningsid=2266&gruppe=188565" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-accent px-5 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark">
                        Nyt Medlem <ExternalLink class="h-4 w-4" />
                    </a>
                    <a href="https://www.conventus.dk/medlemslogin/index.php?forening=2266" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-btn px-5 py-2.5 font-medium text-white transition hover:bg-bif-btn-hover">
                        Login <ExternalLink class="h-4 w-4" />
                    </a>
                </div>
            </div>

            <iframe
                v-if="srcdoc"
                :srcdoc="srcdoc"
                :style="{ height: iframeHeight + 'px' }"
                class="mt-8 w-full rounded-xl border-0 bg-white shadow-md"
                sandbox="allow-scripts allow-popups"
            />
        </div>
    </div>
</template>
