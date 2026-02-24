<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

const form = useForm({
    email: '',
    password: '',
});

function submit() {
    form.post('/login');
}
</script>

<template>
    <Head title="Log ind" />

    <section class="flex items-center justify-center px-4 py-16 md:py-24">
        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-md">
            <h1 class="text-2xl font-bold">Log ind</h1>

            <form class="mt-6 space-y-4" @submit.prevent="submit">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                    />
                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Adgangskode</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-bif-accent focus:outline-none focus:ring-1 focus:ring-bif-accent"
                    />
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-bif-accent px-4 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark disabled:opacity-50"
                >
                    Log ind
                </button>
            </form>
        </div>
    </section>
</template>
