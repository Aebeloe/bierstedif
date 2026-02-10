<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { MapPin, Phone, Mail, Building, CreditCard } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Kontakt" />
    <PageHero title="Kontakt" subtitle="Tag kontakt til Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-start gap-4">
                        <MapPin class="mt-1 h-6 w-6 shrink-0 text-bif-accent" />
                        <div>
                            <h2 class="font-semibold">Adresse</h2>
                            <p class="mt-2 text-bif-muted">Bierstedhallen</p>
                            <p class="text-bif-muted">Idrætsvej 15B</p>
                            <p class="text-bif-muted">Biersted, 9440</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-start gap-4">
                        <Phone class="mt-1 h-6 w-6 shrink-0 text-bif-accent" />
                        <div>
                            <h2 class="font-semibold">Telefon</h2>
                            <a href="tel:61279081" class="mt-2 block text-bif-accent hover:underline">61 27 90 81</a>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-start gap-4">
                        <Mail class="mt-1 h-6 w-6 shrink-0 text-bif-accent" />
                        <div>
                            <h2 class="font-semibold">Email</h2>
                            <a href="mailto:bierstedif@bierstedif.dk" class="mt-2 block text-bif-accent hover:underline">bierstedif@bierstedif.dk</a>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-start gap-4">
                        <Building class="mt-1 h-6 w-6 shrink-0 text-bif-accent" />
                        <div>
                            <h2 class="font-semibold">CVR & Bank</h2>
                            <p class="mt-2 text-bif-muted">CVR: 27682618</p>
                            <p class="text-bif-muted">P-nummer: 1001617675</p>
                            <p class="text-bif-muted">Bank: 7447 2002109</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
