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

function formatDateHeader(dateStr: string): string {
    const d = new Date(dateStr);
    const days = ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'];
    const months = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december'];
    return `${days[d.getDay()]} ${d.getDate()}. ${months[d.getMonth()]}`;
}

function dateKey(dt: string): string {
    const d = new Date(dt);
    return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
}

function addDays(key: string, n: number): string {
    const d = new Date(key + 'T00:00:00');
    d.setDate(d.getDate() + n);
    return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
}

interface CalendarDay {
    date: string;
    shifts: Shift[];
    isGap: boolean;
}

const calendarDays = computed<CalendarDay[]>(() => {
    const grouped = new Map<string, Shift[]>();
    for (const shift of props.shifts) {
        const key = dateKey(shift.start_time);
        if (!grouped.has(key)) grouped.set(key, []);
        grouped.get(key)!.push(shift);
    }

    const dates = [...grouped.keys()].sort();
    if (dates.length === 0) return [];

    const datesWithShifts = new Set(dates);
    const allDates: string[] = [];
    let current = dates[0];
    const last = dates[dates.length - 1];

    while (current <= last) {
        allDates.push(current);
        current = addDays(current, 1);
    }

    // Filter: show date if it has shifts, or if both adjacent days have shifts
    return allDates
        .filter((d) => {
            if (datesWithShifts.has(d)) return true;
            const prev = addDays(d, -1);
            const next = addDays(d, 1);
            return datesWithShifts.has(prev) && datesWithShifts.has(next);
        })
        .map((d) => ({
            date: d,
            shifts: grouped.get(d) || [],
            isGap: !datesWithShifts.has(d),
        }));
});
</script>

<template>
    <Head title="Mosefesten - Vagttilmelding" />
    <PageHero title="Mosefesten" subtitle="Tilmeld dig som frivillig" bg="/mosefestheader.jpeg" :bgContain="true" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-6xl">
            <!-- Intro -->
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Bliv frivillig til Mosefesten</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Mosefesten er afhængig af frivillige hjælpere! Herunder kan du se de ledige vagter
                    og tilmelde dig dem du gerne vil tage. Vælg en vagt, skriv dit navn og kontaktinfo,
                    så er du tilmeldt.
                </p>
            </div>

            <!-- Calendar -->
            <div v-if="calendarDays.length === 0" class="mt-8 rounded-xl bg-white p-6 text-center text-bif-muted shadow-md md:p-8">
                Der er ingen kommende vagter lige nu.
            </div>

            <!-- Calendar grid: dates side by side -->
            <div v-else class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="day in calendarDays" :key="day.date">
                    <!-- Date header -->
                    <h3 class="text-lg font-bold capitalize text-gray-800">
                        {{ formatDateHeader(day.date) }}
                    </h3>

                    <!-- Gap day placeholder -->
                    <div
                        v-if="day.isGap"
                        class="mt-3 rounded-xl border-2 border-dashed border-gray-300 p-6 text-center text-bif-muted"
                    >
                        Ingen vagter denne dag
                    </div>

                    <!-- Shift cards stacked under each date -->
                    <div v-else class="mt-3 space-y-4">
                        <div
                            v-for="shift in day.shifts"
                            :key="shift.id"
                            class="rounded-xl bg-white shadow-md transition"
                            :class="shift.available === 0 ? 'opacity-75' : ''"
                        >
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ shift.name }}</h4>
                                        <p class="mt-1 text-sm text-bif-muted">
                                            {{ formatTime(shift.start_time) }} &ndash; {{ formatTime(shift.end_time) }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex shrink-0 items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                        :class="shift.available > 0 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'"
                                    >
                                        {{ shift.available > 0 ? `${shift.available} af ${shift.total} ledige` : 'Fuldt besat' }}
                                    </span>
                                </div>

                                <p v-if="shift.description" class="mt-2 text-sm leading-relaxed text-bif-muted">
                                    {{ shift.description }}
                                </p>

                                <div v-if="shift.claimed_names.length > 0" class="mt-2 flex flex-wrap gap-1">
                                    <span
                                        v-for="name in shift.claimed_names"
                                        :key="name"
                                        class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800"
                                    >
                                        {{ name }}
                                    </span>
                                </div>

                                <button
                                    v-if="shift.available > 0"
                                    class="mt-4 rounded-lg bg-bif-accent px-4 py-2 text-sm font-medium text-white transition hover:bg-bif-accent-dark"
                                    @click="toggleForm(shift.id)"
                                >
                                    {{ expandedShiftId === shift.id ? 'Annuller' : 'Tilmeld mig' }}
                                </button>
                            </div>

                            <!-- Inline claim form -->
                            <div
                                v-if="expandedShiftId === shift.id && shift.available > 0"
                                class="border-t border-gray-100 p-5"
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
                                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
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
                                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                                        />
                                        <p v-if="claimForm.errors.volunteer_contact" class="mt-1 text-xs text-red-600">{{ claimForm.errors.volunteer_contact }}</p>
                                    </div>
                                    <button
                                        type="submit"
                                        :disabled="claimForm.processing"
                                        class="w-full rounded-lg bg-bif-accent px-4 py-2 text-sm font-medium text-white transition hover:bg-bif-accent-dark disabled:opacity-50"
                                    >
                                        Bekræft tilmelding
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
