<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import ConventusIframe from '@/components/ConventusIframe.vue';
import { Head } from '@inertiajs/vue3';
import { ExternalLink, Users } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const props = defineProps<{ conventusUrl?: string }>();
</script>

<template>
    <Head title="Familiemedlemskab" />
    <PageHero title="Familiemedlemskab" subtitle="Meld hele familien ind i Biersted IF" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <div class="flex items-center gap-3">
                    <Users class="h-8 w-8 text-bif-accent" />
                    <h2 class="text-xl font-bold">Familiemedlemskab</h2>
                </div>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Med et familiemedlemskab kan hele familien nyde godt af Biersted IF's mange tilbud.
                </p>

                <h3 class="mt-6 text-lg font-semibold">Sådan tilmelder du din husstand</h3>
                <ol class="mt-3 list-inside list-decimal space-y-2 leading-relaxed text-bif-muted">
                    <li>Du starter med at oprette dig selv under familiemedlemskab ved at klikke på den grønne knap 'tilmeld'.</li>
                    <li>Det er kun den første, der opretter sig, der skal betale 2.500 kr.</li>
                    <li>Herefter tilmelder resten af familien sig på samme måde ved at klikke på den grønne knap.</li>
                    <li>Er du ikke medlem, skal du først oprette dig ved at klikke på den blå knap 'nyt medlem'.</li>
                    <li>Når man tilmelder sig med (nøjagtig) samme adresse er prisen kr. 0 for de efterfølgende tilmeldinger.</li>
                </ol>

                <div class="mt-6 rounded-lg bg-amber-50 p-4 text-sm leading-relaxed text-amber-800">
                    <p class="font-semibold">Vigtigt!</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        <li>Man må maks. tilmelde fem medlemmer pr. husstand.</li>
                        <li>Alle medlemmer i husstanden skal skrive den nøjagtig samme adresse. De skal matche 100 % inkl. store og små bogstaver, kommaer mv.</li>
                        <li>I kan tjekke om jeres adresse er korrekt her: <a href="https://www.conventus.dk/medlemslogin/index.php?forening=2266" target="_blank" rel="noopener" class="font-medium underline hover:text-amber-900">Conventus medlemslogin</a>.</li>
                        <li>Hvis du bliver bedt om at betale igen, skal du tjekke adressen i den angivne profil.</li>
                        <li>Når alle har tilmeldt sig familiemedlemskabet, kan I frit tilmelde jer andre aktiviteter i foreningen, som I plejer - bare uden at betale igen.</li>
                        <li>Det er vigtigt at I stadig tilmelder jer de hold I vil gå til.</li>
                    </ul>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="https://www.conventus.dk/dataudv/www/new_tilmelding.php?foreningsid=2266&gruppe=188565" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-accent px-5 py-2.5 font-medium text-white transition hover:bg-bif-accent-dark">
                        Nyt Medlem <ExternalLink class="h-4 w-4" />
                    </a>
                    <a href="https://www.conventus.dk/medlemslogin/index.php?forening=2266" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-lg bg-bif-btn px-5 py-2.5 font-medium text-white transition hover:bg-bif-btn-hover">
                        Login <ExternalLink class="h-4 w-4" />
                    </a>
                </div>
            </div>

            <ConventusIframe v-if="conventusUrl" :src="conventusUrl" class="mt-8 rounded-xl shadow-md" />
        </div>
    </div>
</template>
