<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

const conventusUrl = 'https://www.conventus.dk/dataudv/www/booking_v2.php?start=00:00&slut=&forening=2266&navn=vis&ressourcer=vis&login_boks=vis&handelsbetingelser=vis&vis_indre_scrollbar=skjul#uge/lodret/13518;13519;13535;13533;13534;8633;8634;8635;8636;8631;8632;8081;40703;40704;40705;40707;40708;40706;40709;8078;8079;8082';
</script>

<template>
    <Head title="Booking" />
    <PageHero title="Booking" subtitle="Book lokaler i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <p class="leading-relaxed text-bif-muted">
                    Da det primære formål for foreningens lokaler er idræt, er afdelinger og udvalg tilknyttet Biersted IF prioriteret foran private.
                    Bierstedet og eSport kan udelukkende bookes af medlemmer, frivillige eller sponsorer.
                    Hallen og omklædningsrummene kan lejes af alle.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Ved forespørgsel på en dato send en mail til
                    <a href="mailto:booking@bierstedif.dk" class="text-bif-accent hover:underline">booking@bierstedif.dk</a>.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Læs vores <a href="https://docs.google.com/document/d/1jYOkdjgss1-wc0mdkZSIPhHiL-VqEnjBAgVNaFvLFiY/edit?usp=sharing" target="_blank" rel="noopener" class="text-bif-accent hover:underline">Booking Regler</a>.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    For at booke vennestedet besøg
                    <a href="https://bifvk.dk/" target="_blank" rel="noopener" class="text-bif-accent hover:underline">BIFs Vennekreds</a>.
                </p>
            </div>

            <div class="overflow-hidden rounded-xl bg-white shadow-md">
                <iframe
                    :src="conventusUrl"
                    style="height: 800px"
                    class="w-full border-0"
                    sandbox="allow-scripts allow-same-origin allow-popups allow-forms allow-modals"
                />
            </div>
        </div>
    </div>
</template>
