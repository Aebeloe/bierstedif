<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

defineOptions({ layout: MainLayout });

interface HandballMatch {
    id: number;
    date: string;
    time: string;
    homeTeam: string;
    awayTeam: string;
    stadium: string | null;
    row: string | null;
    homeGoals: number | null;
    awayGoals: number | null;
}

const props = defineProps<{
    conventusHtml?: string;
    handballMatches?: HandballMatch[];
}>();

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

function formatDate(dateStr: string): string {
    const d = new Date(dateStr);
    return d.toLocaleDateString('da-DK', { weekday: 'short', day: 'numeric', month: 'short' });
}

function formatTime(timeStr: string): string {
    return timeStr.substring(0, 5);
}

function isBiersted(name: string): boolean {
    return name.toLowerCase().includes('biersted');
}

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
        <div class="mx-auto max-w-5xl space-y-10">
            <!-- Handball matches -->
            <div v-if="handballMatches && handballMatches.length > 0">
                <h2 class="mb-4 text-2xl font-bold">Håndboldkampe</h2>
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-bif-primary text-white">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Dato</th>
                                    <th class="px-4 py-3 font-medium">Tid</th>
                                    <th class="px-4 py-3 font-medium">Hjemme</th>
                                    <th class="px-4 py-3 font-medium">Ude</th>
                                    <th class="px-4 py-3 font-medium">Resultat</th>
                                    <th class="hidden px-4 py-3 font-medium md:table-cell">Sted</th>
                                    <th class="hidden px-4 py-3 font-medium lg:table-cell">Række</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="match in handballMatches" :key="match.id" class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-4 py-3">{{ formatDate(match.date) }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">{{ formatTime(match.time) }}</td>
                                    <td class="px-4 py-3" :class="{ 'font-semibold': isBiersted(match.homeTeam) }">{{ match.homeTeam }}</td>
                                    <td class="px-4 py-3" :class="{ 'font-semibold': isBiersted(match.awayTeam) }">{{ match.awayTeam }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">
                                        <span v-if="match.homeGoals !== null">{{ match.homeGoals }} - {{ match.awayGoals }}</span>
                                        <span v-else class="text-bif-muted">-</span>
                                    </td>
                                    <td class="hidden px-4 py-3 md:table-cell">{{ match.stadium ?? '-' }}</td>
                                    <td class="hidden px-4 py-3 lg:table-cell">{{ match.row ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Conventus calendar -->
            <div>
                <h2 class="mb-4 text-2xl font-bold">Aktiviteter</h2>
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
    </div>
</template>
