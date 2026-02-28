<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineOptions({ layout: MainLayout });

interface Shift {
    id: number;
    name: string;
    description: string | null;
    category: string | null;
    start_time: string;
    end_time: string;
    total: number;
    claimed: number;
    available: number;
    claimed_names: string[];
}

const props = defineProps<{ shifts: Shift[] }>();

const expandedShiftId = ref<number | null>(null);

function toggleForm(id: number) {
    expandedShiftId.value = expandedShiftId.value === id ? null : id;
}

const claimForm = useForm({
    volunteer_name: '',
    volunteer_contact: '',
});

function submitClaim(shiftId: number) {
    claimForm.post(`/tilmeldinger/mosefesten/${shiftId}/claim`, {
        preserveScroll: true,
        onSuccess: () => {
            expandedShiftId.value = null;
            claimForm.reset();
        },
    });
}

function formatTime(dt: string): string {
    const d = new Date(dt);
    return `${String(d.getHours()).padStart(2, '0')}:${String(d.getMinutes()).padStart(2, '0')}`;
}

function formatDateLong(dt: string): string {
    const d = new Date(dt);
    const days = ['Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag'];
    const months = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december'];
    return `${days[d.getDay()]} ${d.getDate()}. ${months[d.getMonth()]}`;
}

function dateKey(dt: string): string {
    const d = new Date(dt);
    return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
}

function weekdayName(dateStr: string): string {
    const d = new Date(dateStr + 'T00:00:00');
    const days = ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'];
    return days[d.getDay()];
}

const activeFilter = ref<{ type: 'date'; value: string } | { type: 'category'; value: string } | null>(null);

const dateTabs = computed(() => {
    const dates = new Set<string>();
    for (const shift of props.shifts) {
        dates.add(dateKey(shift.start_time));
    }
    return [...dates].sort();
});

const categoryTabs = computed(() => {
    const cats = new Set<string>();
    for (const shift of props.shifts) {
        if (shift.category) cats.add(shift.category);
    }
    return [...cats].sort();
});

const currentFilter = computed(() => activeFilter.value ?? (dateTabs.value[0] ? { type: 'date' as const, value: dateTabs.value[0] } : null));

const filteredShifts = computed(() => {
    if (!currentFilter.value) return [];
    if (currentFilter.value.type === 'date') {
        return props.shifts.filter((s) => dateKey(s.start_time) === currentFilter.value!.value);
    }
    return props.shifts.filter((s) => s.category === currentFilter.value!.value);
});

const showDateInRows = computed(() => currentFilter.value?.type === 'category');
</script>

<template>
    <Head title="Mosefesten - Vagttilmelding" />
    <PageHero title="Mosefesten" subtitle="Tilmeld dig som frivillig" bg="/mosefestheader.jpeg" :bgContain="true" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <!-- Intro -->
            <p class="leading-relaxed text-gray-600">
                Mosefesten er byens fælles fest, og som frivillig er du med til at skabe nogle gode dage for
                både børn og voksne. Vælg den opgave og det tidspunkt der passer dig.
            </p>

            <!-- No shifts -->
            <div v-if="props.shifts.length === 0" class="mt-8 rounded-xl bg-white p-6 text-center text-gray-500 shadow-md md:p-8">
                Der er ingen kommende vagter lige nu.
            </div>

            <template v-else>
                <!-- Tabs -->
                <div class="mt-6 flex flex-wrap items-center gap-2">
                    <button
                        v-for="date in dateTabs"
                        :key="date"
                        class="rounded-full px-4 py-1.5 text-sm font-medium transition"
                        :class="currentFilter?.type === 'date' && currentFilter.value === date
                            ? 'bg-green-700 text-white'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        @click="activeFilter = { type: 'date', value: date }"
                    >
                        {{ weekdayName(date) }}
                    </button>

                    <span v-if="categoryTabs.length > 0" class="mx-1 text-gray-300">|</span>

                    <button
                        v-for="cat in categoryTabs"
                        :key="cat"
                        class="rounded-full px-4 py-1.5 text-sm font-medium transition"
                        :class="currentFilter?.type === 'category' && currentFilter.value === cat
                            ? 'bg-green-700 text-white'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        @click="activeFilter = { type: 'category', value: cat }"
                    >
                        {{ cat }}
                    </button>
                </div>

                <!-- Shift list -->
                <div class="mt-6 divide-y divide-gray-200">
                    <div
                        v-for="shift in filteredShifts"
                        :key="shift.id"
                        class="py-5"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <!-- Left: shift info -->
                            <div class="min-w-0 flex-1">
                                <h4 class="font-semibold text-gray-900">{{ shift.name }}</h4>
                                <p class="mt-0.5 text-sm text-gray-500">
                                    <template v-if="showDateInRows">{{ formatDateLong(shift.start_time) }} </template>
                                    {{ formatTime(shift.start_time) }} &ndash; {{ formatTime(shift.end_time) }}
                                </p>

                                <!-- Numbered volunteer list -->
                                <div class="mt-2 space-y-0.5">
                                    <p
                                        v-for="(name, i) in shift.claimed_names"
                                        :key="i"
                                        class="text-sm text-gray-600"
                                    >
                                        #{{ i + 1 }}: {{ name }}
                                    </p>
                                    <p
                                        v-if="shift.available > 0"
                                        class="cursor-pointer text-sm font-medium text-green-700"
                                        @click="toggleForm(shift.id)"
                                    >
                                        {{ expandedShiftId === shift.id ? 'Annuller' : `#${shift.claimed + 1}: Tilmeld \u00BB` }}
                                    </p>
                                </div>
                            </div>

                            <!-- Right: action button -->
                            <div class="shrink-0 pt-1">
                                <button
                                    v-if="shift.available > 0"
                                    class="rounded-full bg-green-700 px-5 py-1.5 text-sm font-medium text-white transition hover:bg-green-800"
                                    @click="toggleForm(shift.id)"
                                >
                                    Tilmeld dig
                                </button>
                                <span
                                    v-else
                                    class="inline-block rounded-full border border-gray-300 px-5 py-1.5 text-sm font-medium text-gray-400"
                                >
                                    Fuldt booket
                                </span>
                            </div>
                        </div>

                        <!-- Inline claim form -->
                        <div
                            v-if="expandedShiftId === shift.id && shift.available > 0"
                            class="mt-4 rounded-lg bg-gray-50 p-4"
                        >
                            <form @submit.prevent="submitClaim(shift.id)" class="space-y-3">
                                <div>
                                    <label :for="'name-' + shift.id" class="block text-sm font-medium text-gray-700">Navn</label>
                                    <input
                                        :id="'name-' + shift.id"
                                        v-model="claimForm.volunteer_name"
                                        type="text"
                                        required
                                        placeholder="Dit fulde navn"
                                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600"
                                    />
                                    <p v-if="claimForm.errors.volunteer_name" class="mt-1 text-xs text-red-600">{{ claimForm.errors.volunteer_name }}</p>
                                </div>
                                <div>
                                    <label :for="'contact-' + shift.id" class="block text-sm font-medium text-gray-700">Telefon</label>
                                    <input
                                        :id="'contact-' + shift.id"
                                        v-model="claimForm.volunteer_contact"
                                        type="text"
                                        required
                                        placeholder="Tlf."
                                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600"
                                    />
                                    <p v-if="claimForm.errors.volunteer_contact" class="mt-1 text-xs text-red-600">{{ claimForm.errors.volunteer_contact }}</p>
                                </div>
                                <button
                                    type="submit"
                                    :disabled="claimForm.processing"
                                    class="rounded-full bg-green-700 px-6 py-2 text-sm font-medium text-white transition hover:bg-green-800 disabled:opacity-50"
                                >
                                    Bekræft tilmelding
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer message -->
                <p class="mt-10 text-center text-sm italic text-gray-400">
                    Tak fordi du hjælper<br />
                    Uden frivillige, ingen Mosefest
                </p>
            </template>
        </div>
    </div>
</template>
