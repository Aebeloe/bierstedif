<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Head, usePage, router, useForm } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

interface User {
    id: number;
    name: string;
    email: string;
}

interface Shift {
    id: number;
    name: string;
    description: string | null;
    start_time: string;
    end_time: string;
    assignee: User | null;
}

const page = usePage<{
    auth: { user: User };
    shifts: Shift[];
}>();
const user = page.props.auth.user;

const form = useForm({
    name: '',
    description: '',
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
        start_time: parseDanishDate(data.start_date, data.start_time),
        end_time: parseDanishDate(data.end_date, data.end_time),
        quantity: data.quantity,
    })).post('/shifts', { onSuccess: () => form.reset() });
}

function deleteShift(id: number) {
    router.delete(`/shifts/${id}`);
}

function logout() {
    router.post('/logout');
}

function formatDateTime(dt: string): string {
    const d = new Date(dt);
    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();
    const hours = String(d.getHours()).padStart(2, '0');
    const minutes = String(d.getMinutes()).padStart(2, '0');
    return `${day}/${month}/${year} ${hours}:${minutes}`;
}
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

            <!-- Shifts Table -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Vagter</h2>

                <div v-if="page.props.shifts.length === 0" class="mt-4 text-gray-500">
                    Ingen vagter oprettet endnu.
                </div>

                <div v-else class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-600">
                                <th class="pb-3 pr-4 font-medium">Navn</th>
                                <th class="pb-3 pr-4 font-medium">Beskrivelse</th>
                                <th class="pb-3 pr-4 font-medium">Start</th>
                                <th class="pb-3 pr-4 font-medium">Slut</th>
                                <th class="pb-3 pr-4 font-medium">Tildelt</th>
                                <th class="pb-3 font-medium"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="shift in page.props.shifts"
                                :key="shift.id"
                                class="border-b border-gray-100 last:border-0"
                            >
                                <td class="py-3 pr-4 font-medium">{{ shift.name }}</td>
                                <td class="py-3 pr-4 text-gray-600">{{ shift.description || '—' }}</td>
                                <td class="py-3 pr-4 whitespace-nowrap">{{ formatDateTime(shift.start_time) }}</td>
                                <td class="py-3 pr-4 whitespace-nowrap">{{ formatDateTime(shift.end_time) }}</td>
                                <td class="py-3 pr-4">{{ shift.assignee?.name || '—' }}</td>
                                <td class="py-3 text-right">
                                    <button
                                        class="rounded-lg bg-red-100 px-3 py-1 text-sm font-medium text-red-700 transition hover:bg-red-200"
                                        @click="deleteShift(shift.id)"
                                    >
                                        Slet
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>
