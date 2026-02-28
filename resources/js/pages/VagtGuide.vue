<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="Vagtsystemet - Guide" />

    <section class="px-4 py-16 md:py-24">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-8 shadow-md">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold">Vagtsystemet</h1>
                    <Link
                        href="/dashboard"
                        class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-300"
                    >
                        Tilbage til dashboard
                    </Link>
                </div>

                <p class="mt-4 leading-relaxed text-gray-600">
                    Vagtsystemet giver dig mulighed for at oprette og administrere frivilligvagter til Mosefesten. Herunder er en kort gennemgang af hvordan det fungerer.
                </p>
            </div>

            <!-- Opret vagter -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Opret vagter</h2>
                <p class="mt-4 leading-relaxed text-gray-600">
                    Under <Link href="/dashboard" class="font-medium text-bif-accent hover:underline">Dashboard</Link> kan du oprette vagter med følgende felter:
                </p>
                <ul class="mt-4 space-y-2 text-gray-600">
                    <li class="flex gap-2">
                        <span class="font-semibold text-gray-800">Navn</span>
                        <span>&ndash; vagtens titel (f.eks. &ldquo;Cafeteriesalg&rdquo; eller &ldquo;Tidtagning til Padel&rdquo;)</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-semibold text-gray-800">Beskrivelse</span>
                        <span>&ndash; valgfri uddybning af hvad vagten indebærer</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-semibold text-gray-800">Kategori</span>
                        <span>&ndash; valgfri gruppering (f.eks. &ldquo;Bar&rdquo;, &ldquo;Mad&rdquo;, &ldquo;Opsætning&rdquo;). Kategorier vises som faneblade på tilmeldingssiden, så besøgende kan filtrere efter opgavetype</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-semibold text-gray-800">Start- og slutdato/tid</span>
                        <span>&ndash; hvornår vagten finder sted, angives i formatet dd/mm/åååå</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="font-semibold text-gray-800">Antal</span>
                        <span>&ndash; hvor mange frivillige der skal bruges til denne vagt (opretter flere identiske pladser)</span>
                    </li>
                </ul>
            </div>

            <!-- Tilmeldingssiden -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Tilmeldingssiden</h2>
                <p class="mt-4 leading-relaxed text-gray-600">
                    Besøgende kan tilmelde sig vagter på <Link href="/tilmeldinger/mosefesten" class="font-medium text-bif-accent hover:underline">tilmeldingssiden</Link>. Siden viser vagter filtreret via faneblade &ndash; enten efter <strong class="text-gray-800">ugedag</strong> eller <strong class="text-gray-800">kategori</strong>. Frivillige skriver deres navn og telefonnummer for at tilmelde sig en ledig plads.
                </p>
            </div>

            <!-- Synlighed -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Synlighed</h2>
                <p class="mt-4 leading-relaxed text-gray-600">
                    Med kontakten <strong class="text-gray-800">&ldquo;Mosefesten synlig for besøgende&rdquo;</strong> på Dashboard styrer du om tilmeldingssiden er offentligt tilgængelig. Når den er slået fra, kan kun indloggede administratorer se siden.
                </p>
            </div>

            <!-- Overblik og sletning -->
            <div class="rounded-xl bg-white p-8 shadow-md">
                <h2 class="text-xl font-bold">Overblik og sletning</h2>
                <p class="mt-4 leading-relaxed text-gray-600">
                    På Dashboard kan du se alle vagter med en oversigt over hvem der har tilmeldt sig (navn og kontaktinfo). Du kan slette en hel vagtgruppe hvis den ikke længere er aktuel.
                </p>
            </div>
        </div>
    </section>
</template>
