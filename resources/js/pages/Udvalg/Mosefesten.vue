<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref, onMounted, onBeforeUnmount } from 'vue';

defineOptions({ layout: MainLayout });

const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth?.user);
const showTickets = computed(() => isLoggedIn.value || new Date() >= new Date('2026-03-17'));

const iframeHeight = ref(400);

function onMessage(e: MessageEvent) {
    if (e.data?.type === 'conventus-resize-billet' && typeof e.data.height === 'number') {
        iframeHeight.value = e.data.height;
    }
}

onMounted(() => window.addEventListener('message', onMessage));
onBeforeUnmount(() => window.removeEventListener('message', onMessage));
</script>

<template>
    <Head title="Mosefesten" />
    <PageHero title="Mosefesten" subtitle="Årlig byfest i Biersted" bg="/mosefestheader.jpeg" :bgContain="true" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <!-- Ticket sales -->
            <div v-if="showTickets" class="mb-8 rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="mb-4 text-xl font-bold">Billetter</h2>
                <iframe
                    src="/conventus-embed-billet/mosefesten"
                    :style="{ height: iframeHeight + 'px', overflow: 'hidden' }"
                    scrolling="no"
                    class="w-full border-0 bg-white"
                />
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Mosefesten</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Mosefesten er en årlig tilbagevendende begivenhed som ligger 2. weekend i juni.
                    Formålet med Mosefesten er at samle byens folk på pladsen med masser af hygge og samvær.
                    Der er optog, gadefodbold, madboder, hoppeborge, musik og andre aktiviteter som svinger fra år til år.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Vi er meget afhængig af vores fantastisk frivillige, så er du interesseret i at give en hånd med, så henvend dig endelig.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Følg med på vores <a href="https://www.facebook.com/groups/353529648002895/?ref=share_group_link&mibextid=wwXIfr&rdid=UwgI4ByW4HuP7xK5&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2Fg%2F1GGDWjFs7Z%2F%3Fmibextid%3DwwXIfr#" target="_blank" rel="noopener" class="text-bif-accent hover:underline">Facebook-side</a>,
                    under om står navnene på den siddende bestyrelse, på siden lægger vi videoer, opfordringer og programmer op løbende.
                </p>
            </div>
        </div>
    </div>
</template>
