<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Moseløbet" />
    <PageHero title="Moseløbet" subtitle="Det årlige motionsløb i Biersted" bg="/moseloebheader.jpg" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-6">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om Moseløbet</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Før Mosefesten løber af stablen, vil vi gerne opfordre alle der har lyst til at løbe eller gå om at
                    deltage i Moseløbet. Løbet bliver skudt i gang Grundlovsdag den 5. juni kl. 16:00 med start fra hallen.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Der bliver mulighed for at løbe, gå eller cykle 5 eller 10 kilometer. Ruterne kan ses på Biersted Idrætsforenings hjemmeside.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    På fodboldbanerne ved hallen bliver det muligt at deltage i et 'sponsorløb' for hele familien.
                    Tilmelding til sponsorløbet er ikke nødvendig, men man skal til gengæld selv finde sine sponsorer.
                    På Biersted IF's hjemmeside kan man udskrive en kontrakt, som skal udfyldes og afleveres ved
                    tidtagerbordet inden man løber.
                </p>
                <div class="mt-4">
                    <a
                        href="/Moseløbskontrakt 2019.pdf"
                        download
                        class="inline-block rounded-lg bg-bif-accent px-6 py-3 font-semibold text-white transition hover:opacity-90"
                    >
                        Download sponsorkontrakt
                    </a>
                </div>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Al overskud fra motionsløbet og sponsorløbet går til byens børn og unge. Få masser af motion
                    sammen med en masse andre gode mennesker i Biersted — samtidig med, at vi løber penge ind til byens børn.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Billetter</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Køb din billet til Moseløbet her og sikr dig en plads på startstregen.
                </p>
                <div class="mt-6">
                    <a
                        href="https://place2book.com/da/sw2/sales/g8bt6t9qs7"
                        target="_blank"
                        rel="noopener"
                        class="inline-block rounded-lg bg-bif-accent px-6 py-3 font-semibold text-white transition hover:opacity-90"
                    >
                        Køb billetter
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
