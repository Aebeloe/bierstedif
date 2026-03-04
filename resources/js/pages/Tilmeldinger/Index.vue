<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';

defineOptions({ layout: MainLayout });

const props = defineProps<{ sections: Record<string, string> }>();

const tabs = [
    { key: 'Badminton', label: 'Badminton' },
    { key: 'Fodbold', label: 'Fodbold' },
    { key: 'Gymnastik', label: 'Gymnastik' },
    { key: 'Haandbold', label: 'Håndbold' },
    { key: 'Floorball', label: 'Floorball' },
    { key: 'Dart', label: 'Dart' },
    { key: 'Esport', label: 'Esport' },
    { key: 'Familiemedlemskab', label: 'Familiemedlemskab' },
    { key: 'Ungdomsklub', label: 'Ungdomsklub' },
    { key: 'OevrigeHold', label: 'Øvrige Hold' },
    { key: 'Alle', label: 'Alle' },
];

const activeTab = ref('Badminton');

const sportTabs = tabs.filter(t => t.key !== 'Alle');

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
            <div class="mb-8 flex flex-wrap gap-2">
                <button
                    v-for="tab in tabs"
                    :key="tab.key"
                    @click="activeTab = tab.key"
                    :class="[
                        'cursor-pointer rounded-full px-4 py-2 text-sm font-medium transition',
                        activeTab === tab.key
                            ? 'bg-bif-accent text-white'
                            : 'bg-white text-bif-dark shadow-sm hover:bg-gray-50',
                    ]"
                >
                    {{ tab.label }}
                </button>
            </div>

            <template v-if="activeTab === 'Alle'">
                <div v-for="tab in sportTabs" :key="tab.key" class="mb-10 last:mb-0">
                    <h3 class="mb-4 text-lg font-semibold">{{ tab.label }}</h3>
                    <iframe
                        v-if="srcdoc(tab.key)"
                        :srcdoc="srcdoc(tab.key)"
                        :style="{ height: (iframeHeights[tab.key] || 400) + 'px', overflow: 'hidden' }"
                        scrolling="no"
                        class="w-full rounded-xl border-0 bg-white shadow-md"
                        sandbox="allow-scripts allow-popups allow-forms allow-modals"
                    />
                </div>
            </template>
            <iframe
                v-else-if="srcdoc(activeTab)"
                :key="activeTab"
                :srcdoc="srcdoc(activeTab)"
                :style="{ height: (iframeHeights[activeTab] || 400) + 'px', overflow: 'hidden' }"
                scrolling="no"
                class="w-full rounded-xl border-0 bg-white shadow-md"
                sandbox="allow-scripts allow-popups allow-forms allow-modals"
            />
        </div>
    </div>
</template>
