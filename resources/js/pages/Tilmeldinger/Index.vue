<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, onMounted, onBeforeUnmount } from 'vue';

defineOptions({ layout: MainLayout });

const props = defineProps<{ sections: Record<string, string> }>();

const categories = [
    {
        title: 'Sport',
        items: [
            { key: 'Badminton', label: 'Badminton' },
            { key: 'Fodbold', label: 'Fodbold' },
            { key: 'Gymnastik', label: 'Gymnastik' },
            { key: 'Haandbold', label: 'Håndbold' },
            { key: 'Floorball', label: 'Floorball' },
            { key: 'Dart', label: 'Dart' },
            { key: 'Esport', label: 'Esport' },
        ],
    },
    {
        title: 'Andet',
        items: [
            { key: 'Familiemedlemskab', label: 'Familiemedlemskab' },
            { key: 'Ungdomsklub', label: 'Ungdomsklub' },
            { key: 'OevrigeHold', label: 'Øvrige Hold' },
        ],
    },
];

const iframeHeights = reactive<Record<string, number>>({});

function srcdoc(key: string): string {
    const html = props.sections[key];
    if (!html) return '';
    return `<!DOCTYPE html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<style>body{margin:0;font-family:system-ui,-apple-system,sans-serif;}</style></head>
<body>${html}
<script>
function inv_dis(id){var el=document.getElementById(id);if(el){el.style.display=el.style.display==='none'?'':'none';requestAnimationFrame(function(){parent.postMessage({type:'conventus-resize',key:'${key}',height:document.body.scrollHeight},'*');});}}
new ResizeObserver(function(){parent.postMessage({type:'conventus-resize',key:'${key}',height:document.body.scrollHeight},'*');}).observe(document.body);
<\/script></body></html>`;
}

function onMessage(e: MessageEvent) {
    if (e.data?.type === 'conventus-resize' && e.data.key) {
        iframeHeights[e.data.key] = e.data.height;
    }
}

onMounted(() => window.addEventListener('message', onMessage));
onBeforeUnmount(() => window.removeEventListener('message', onMessage));
</script>

<template>
    <Head title="Tilmeldinger" />
    <PageHero title="Tilmeldinger" subtitle="Find dit hold og tilmeld dig" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div v-for="category in categories" :key="category.title" class="mb-16 last:mb-0">
                <h2 class="mb-8 text-2xl font-bold">{{ category.title }}</h2>

                <div v-for="item in category.items" :key="item.key" class="mb-10 last:mb-0">
                    <h3 class="mb-4 text-lg font-semibold">{{ item.label }}</h3>
                    <iframe
                        v-if="srcdoc(item.key)"
                        :srcdoc="srcdoc(item.key)"
                        :style="{ height: (iframeHeights[item.key] || 400) + 'px', overflow: 'hidden' }"
                        scrolling="no"
                        class="w-full rounded-xl border-0 bg-white shadow-md"
                        sandbox="allow-scripts allow-popups allow-forms allow-modals"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
