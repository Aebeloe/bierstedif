<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Shirt, ExternalLink } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Klubdragt" />
    <PageHero title="Klubdragt" subtitle="Bestil klubdragt, spillerdragt mm. hos Biersted IF's tøjleverandør" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <div class="flex items-center gap-3">
                    <Shirt class="h-8 w-8 text-bif-accent" />
                    <h2 class="text-xl font-bold">Bestil klubtøj</h2>
                </div>

                <p class="mt-4 leading-relaxed text-bif-muted">
                    Biersted IF's klubdragt og spillerdragter kan bestilles online hos vores tøjleverandør Sport Direct.
                    Som medlem får du alle overdele med klublogo.
                </p>

                <div class="mt-6 rounded-lg bg-bif-bg p-4">
                    <p class="text-sm font-medium">Login-oplysninger til medlemsbutikken:</p>
                    <p class="mt-2 text-sm text-bif-muted"><span class="font-medium text-bif-fg">Email:</span> klub10@a-sport.dk</p>
                    <p class="text-sm text-bif-muted"><span class="font-medium text-bif-fg">Password:</span> BierstedMedlem</p>
                </div>

                <p class="mt-4 text-sm text-bif-muted">
                    Du kan tilføje initialer (varenr. #40930-4) eller navne på tøjet (varenr. #40930-3).
                    Angiv dette i kommentarfeltet ved bestilling.
                </p>

                <div class="mt-6 overflow-hidden rounded-lg">
                    <img src="/klubdragt.png" alt="Biersted IF Klubdragt" class="mx-auto max-w-xs object-cover" />
                </div>

                <a
                    href="https://a-sport.dk/shop/fodbold/spille-og-fritidstoej/biersted-if/"
                    target="_blank"
                    rel="noopener"
                    class="mt-6 inline-flex items-center gap-2 rounded-lg bg-bif-accent px-5 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark"
                >
                    Gå til butikken
                    <ExternalLink class="h-4 w-4" />
                </a>
            </div>
        </div>
    </div>
</template>
