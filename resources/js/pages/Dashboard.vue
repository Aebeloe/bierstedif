<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Head, usePage, router, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

defineOptions({ layout: MainLayout });

interface User {
    id: number;
    name: string;
    email: string;
}

interface Volunteer {
    name: string;
    contact: string;
}

interface Shift {
    name: string;
    description: string | null;
    category: string | null;
    start_time: string;
    end_time: string;
    total: number;
    claimed: number;
    available: number;
    volunteers: Volunteer[];
    shift_ids: number[];
}

const props = defineProps<{
    mosefestenPublic: boolean;
}>();

const page = usePage<{
    auth: { user: User };
    shifts: Shift[];
}>();
const user = page.props.auth.user;

const form = useForm({
    name: '',
    description: '',
    category: '',
    start_date: '',
    start_time: '',
    end_date: '',
    end_time: '',
    quantity: 1,
});

function parseDanishDate(date: string, time: string): string {
    const [day, month, year] = date.split('/');
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}T${time}`;
}

function createShifts() {
    form.transform((data) => ({
        name: data.name,
        description: data.description,
        category: data.category || null,
        start_time: parseDanishDate(data.start_date, data.start_time),
        end_time: parseDanishDate(data.end_date, data.end_time),
        quantity: data.quantity,
    })).post('/shifts', { onSuccess: () => form.reset() });
}

function deleteShiftGroup(ids: number[]) {
    if (!confirm(`Slet alle ${ids.length} vagt(er) i denne gruppe?`)) return;
    ids.forEach((id) => router.delete(`/shifts/${id}`, { preserveScroll: true }));
}

function toggleMosefesten() {
    router.post('/dashboard/toggle-mosefesten');
}

function logout() {
    router.post('/logout');
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

interface CalendarDay {
    date: string;
    shifts: Shift[];
}

const calendarDays = computed<CalendarDay[]>(() => {
    const grouped = new Map<string, Shift[]>();
    for (const shift of page.props.shifts) {
        const key = dateKey(shift.start_time);
        if (!grouped.has(key)) grouped.set(key, []);
        grouped.get(key)!.push(shift);
    }

    return [...grouped.entries()]
        .sort(([a], [b]) => a.localeCompare(b))
        .map(([date, shifts]) => ({ date, shifts }));
});
</script>

<template>
    <Head title="Dashboard" />

    <section class="px-4 py-16 md:py-24">
        <div class="mx-auto max-w-4xl space-y-8">
            <!-- Header -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold">Velkommen, {{ user.name }}</h1>
                    <button
                        class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-300"
                        @click="logout"
                    >
                        Log ud
                    </button>
                </div>

                <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">
                    <span class="text-sm font-medium text-gray-700">Mosefesten synlig for besøgende</span>
                    <button
                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-bif-accent focus:ring-offset-2"
                        :class="props.mosefestenPublic ? 'bg-bif-accent' : 'bg-gray-200'"
                        role="switch"
                        :aria-checked="props.mosefestenPublic"
                        @click="toggleMosefesten"
                    >
                        <span
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                            :class="props.mosefestenPublic ? 'translate-x-5' : 'translate-x-0'"
                        />
                    </button>
                </div>
            </div>

            <!-- Create Shift Form -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Opret vagter</h2>

                <form class="mt-6 space-y-4" @submit.prevent="createShifts">
                    <div>
                        <label for="shift-name" class="block text-sm font-medium text-gray-700">Navn</label>
                        <input
                            id="shift-name"
                            v-model="form.name"
                            type="text"
                            required
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                        />
                        <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="shift-description" class="block text-sm font-medium text-gray-700">Beskrivelse</label>
                        <textarea
                            id="shift-description"
                            v-model="form.description"
                            rows="2"
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                        />
                        <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                    </div>

                    <div>
                        <label for="shift-category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <input
                            id="shift-category"
                            v-model="form.category"
                            type="text"
                            placeholder="F.eks. Bar, Scene, Rengøring..."
                            class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                        />
                        <p v-if="form.errors.category" class="mt-1 text-sm text-red-600">{{ form.errors.category }}</p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="shift-start-date" class="block text-sm font-medium text-gray-700">Startdato</label>
                            <input
                                id="shift-start-date"
                                v-model="form.start_date"
                                type="text"
                                placeholder="dd/mm/åååå"
                                pattern="\d{1,2}/\d{1,2}/\d{4}"
                                required
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                            />
                        </div>

                        <div>
                            <label for="shift-start-time" class="block text-sm font-medium text-gray-700">Starttid</label>
                            <input
                                id="shift-start-time"
                                v-model="form.start_time"
                                type="time"
                                required
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                            />
                            <p v-if="form.errors.start_time" class="mt-1 text-sm text-red-600">{{ form.errors.start_time }}</p>
                        </div>

                        <div>
                            <label for="shift-end-date" class="block text-sm font-medium text-gray-700">Slutdato</label>
                            <input
                                id="shift-end-date"
                                v-model="form.end_date"
                                type="text"
                                placeholder="dd/mm/åååå"
                                pattern="\d{1,2}/\d{1,2}/\d{4}"
                                required
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                            />
                        </div>

                        <div>
                            <label for="shift-end-time" class="block text-sm font-medium text-gray-700">Sluttid</label>
                            <input
                                id="shift-end-time"
                                v-model="form.end_time"
                                type="time"
                                required
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                            />
                            <p v-if="form.errors.end_time" class="mt-1 text-sm text-red-600">{{ form.errors.end_time }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label for="shift-quantity" class="block text-sm font-medium text-gray-700">Antal</label>
                            <input
                                id="shift-quantity"
                                v-model.number="form.quantity"
                                type="number"
                                min="1"
                                max="50"
                                required
                                class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                            />
                            <p v-if="form.errors.quantity" class="mt-1 text-sm text-red-600">{{ form.errors.quantity }}</p>
                        </div>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-lg bg-bif-accent px-6 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark disabled:opacity-50"
                    >
                        Opret
                    </button>
                </form>
            </div>

            <!-- Shifts -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Vagter</h2>

                <div v-if="page.props.shifts.length === 0" class="mt-4 text-gray-500">
                    Ingen vagter oprettet endnu.
                </div>

                <div v-else class="mt-6 space-y-8">
                    <div v-for="day in calendarDays" :key="day.date">
                        <h3 class="text-lg font-bold capitalize text-gray-800">
                            {{ formatDateHeader(day.date) }}
                        </h3>

                        <div class="mt-3 space-y-4">
                            <div
                                v-for="shift in day.shifts"
                                :key="shift.shift_ids.join(',')"
                                class="rounded-xl border border-gray-200 p-5"
                                :class="shift.available === 0 ? 'bg-green-50' : ''"
                            >
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">
                                            {{ shift.name }}
                                            <span v-if="shift.category" class="ml-2 inline-flex items-center rounded-full bg-purple-100 px-2 py-0.5 text-xs font-medium text-purple-800">{{ shift.category }}</span>
                                        </h4>
                                        <p class="mt-1 text-sm text-bif-muted">
                                            {{ formatTime(shift.start_time) }} &ndash; {{ formatTime(shift.end_time) }}
                                        </p>
                                    </div>
                                    <div class="flex shrink-0 items-center gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                            :class="shift.available > 0 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'"
                                        >
                                            {{ shift.available > 0 ? `${shift.claimed}/${shift.total} besat` : 'Fuldt besat' }}
                                        </span>
                                        <button
                                            class="rounded-lg bg-red-100 px-3 py-1 text-xs font-medium text-red-700 transition hover:bg-red-200"
                                            @click="deleteShiftGroup(shift.shift_ids)"
                                        >
                                            Slet
                                        </button>
                                    </div>
                                </div>

                                <p v-if="shift.description" class="mt-2 text-sm text-bif-muted">
                                    {{ shift.description }}
                                </p>

                                <div v-if="shift.volunteers.length > 0" class="mt-3">
                                    <div
                                        v-for="(v, i) in shift.volunteers"
                                        :key="i"
                                        class="flex items-center gap-2 border-t border-gray-100 py-2 text-sm first:border-0"
                                    >
                                        <span class="font-medium text-gray-800">{{ v.name }}</span>
                                        <span v-if="v.contact" class="text-gray-500">{{ v.contact }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
