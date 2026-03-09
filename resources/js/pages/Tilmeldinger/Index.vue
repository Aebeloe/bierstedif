<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import ConventusIframe from '@/components/ConventusIframe.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

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
                    <ConventusIframe v-if="sections[tab.key]" :src="sections[tab.key]" class="rounded-xl shadow-md" />
                </div>
            </template>
            <ConventusIframe
                v-else-if="sections[activeTab]"
                :key="activeTab"
                :src="sections[activeTab]"
                class="rounded-xl shadow-md"
            />
        </div>
    </div>
</template>
