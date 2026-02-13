<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Building2, Users, Palette } from 'lucide-vue-next';

defineOptions({ layout: MainLayout });
</script>

<template>
    <Head title="TUEN" />
    <PageHero title="TUEN" subtitle="Udviklingsprojekt for kultur- og sportsfaciliteter i Biersted" bg="/tuenheader.jpg" bg-position="center 70%" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-3xl space-y-8">
            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">Om TUEN-projektet</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    TUEN er et projekt der går ud på at udvikle og optimere kultur- og idrætsfaciliteter i Biersted.
                    Det skal opnåes ved at gøre den eksisterende hal mere tilgængelig, fleksibel og synlig og ved at
                    opføre en bygning ved siden af hallen med fokus på sanser og motorik.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Projektet skal give skole, idrætsforening og kulturliv en stor variation af muligheder og ikke bare
                    gøre stedet til et samlingssted for hele lokalområdet, men også tiltrække folk længere væk fra pga.
                    de unikke faciliteter der er planlagt. Særligt de faciliteter der tager udgangspunkt i behovene som
                    ASF-børn og andre børn med særlige behov har.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Målet er at skabe et sted, der har relevans for elever, idrætsudøvere og borgere mange år ud i
                    fremtiden, og på den måde være med til at fremtidssikre institutioner, foreninger og bosætning
                    i vores område.
                </p>
            </div>

            <div class="space-y-4">
                <img src="/tuen1.png" alt="Det Sansemotoriske Hus - interiør" class="rounded-xl shadow-md w-full" />
                <div class="grid grid-cols-2 gap-4">
                    <img src="/tuen2.jpg" alt="Det Sansemotoriske Hus - plantegning" class="rounded-xl shadow-md object-cover w-full h-56" />
                    <img src="/tuen3.png" alt="Det Sansemotoriske Hus - overblik" class="rounded-xl shadow-md object-cover w-full h-56" />
                </div>
            </div>

            <div class="rounded-xl bg-white shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-xl font-bold">En generalprøve på indvielsen</h2>
                    <p class="mt-4 leading-relaxed text-bif-muted">
                        Ved aflevering af ansøgning til Jammerbugt Kommune blev der afholdt en generalprøve på den indvielse,
                        der forhåbentlig kommer inden længe.
                    </p>
                    <p class="mt-4 leading-relaxed text-bif-muted">
                        Omtale fra Aabybroposten
                    </p>
                    <p class="mt-4 leading-relaxed text-bif-muted">
                        Omtale fra Vores Jammerbugt
                    </p>
                </div>
                <img src="/tuengeneral.jpg" alt="Generalprøve på indvielsen" class="w-full" />
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h2 class="text-xl font-bold">TUEN</h2>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Målet er at imødekomme behovene fra tre grupper:
                </p>
                <ul class="mt-2 list-disc pl-6 text-bif-muted">
                    <li>Børn og unge med særlige behov (ASF)</li>
                    <li>Nye og eksisterende idrætsaktiviteter (BIF)</li>
                    <li>Kulturelle aktiviteter (Biersted)</li>
                </ul>

                <h3 class="mt-6 text-lg font-semibold">Børn og unge med særlige behov</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    I Biersted ligger Jammerbugt Kommunes ASF-afdeling og ASF-børnehave. ASF-afdelingen er gået fra at have
                    til 7 elever til nu at rumme mere end 60. Der er derfor pladsmangel og der er især mangel på lokaler,
                    hvor der er tænkt på lyd, lys og aktiviteter der kan udfordre den enkelte. Det vil huset kunne.
                </p>

                <h3 class="mt-6 text-lg font-semibold">Almene idrætsaktiviteter</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Biersted har en stor og aktiv idrætsforening og der er pres på hallen. Nogle aktiviteter kan flyttes
                    til den nye sal og give plads til andre aktiviteter i hallen. Der vil med springgrav, klatrevæg mm.
                    være grobund for mange nye aktiviteter.
                </p>

                <h3 class="mt-6 text-lg font-semibold">Kulturelle aktiviteter</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Biersted har ikke et forsamlingshus og derfor efterlyser Landsbyrådet og Borgerforeningen lokaler til
                    foredrag, banko, koncerter og lignende. Huset vil gøre det muligt at tilbyde mere kultur til borgerne.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h3 class="text-lg font-semibold">Mulighederne</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Lokalt kan idrætsforeningens ønske om et generelt anvendelig hus, kombineres med specialklassernes
                    behov for specialdesignede lokaler til den daglige sansemotoriske træning. På længere sigt kan TUEN
                    danne et indtægtsgivende grundlag, der kan være med til at fremtidssikre idrætsforeningens økonomiske
                    grundlag og samtidig være styrkende for fællesskabet i området.
                </p>

                <h3 class="mt-6 text-lg font-semibold">Indretning</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Et hus hvor der lægges vægt på god akustik og belysning og hvor både sanser og motortik bliver
                    stimuleret. Foreløbige forslag til udnyttelse er: badmintonbaner, hockeybane, springgrav, klatrevæg og scene.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    I de tilstødende lokaler er der også fokus på god akustik og belysning, og lokalerne foreslås brugt til:
                    cafémiljø, massage, fysioterapi, yoga, fitness, golfsimulator, Virtual Reality og depot.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h3 class="text-lg font-semibold">Fra idé til realitet</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Idéen er grundlagt i et projektforløb med LandLab, hvor målet for Bierstedhallen gennem borgermøder
                    og interessentmøder har været, at:
                </p>
                <ul class="mt-2 list-disc pl-6 text-bif-muted">
                    <li>genfinde en aktualitet tilpasset tidens behov</li>
                    <li>virke som dynamo og drivkraft for lokalsamfundsudvikling</li>
                    <li>fortsat have en sund økonomi</li>
                </ul>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Projektet har fokus på at 'løfte blikket' og identificere nye lokale muligheder, der ikke nødvendigvis
                    tager afsæt i bestyrelsernes traditionelle rødder i idrætslivet.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h3 class="text-lg font-semibold">Jammerbugt Kommune</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Initiativgruppen er optimistiske mht. samarbejde med kommunen. Ikke mindst på baggrund af kommunens
                    strategi vedtaget i 2017 for kultur, fritid og landdistrikter: "Ildsjæle gør forskellen".
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Strategien tager udgangspunkt i planstrategiens vision: "Vi går efter forskellen", som udpeger fire
                    temaer: Mere i gang – flere i gang. Dit gode liv. Vi gør det på 'jammerbugtsk'. Sådan er vi bæredygtige.
                </p>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Med afsæt i de fire temaer har kommunalbestyrelsen formuleret fem tværgående og handlingsorienterede
                    områder som Jammerbugt Kommune vil have succes med:
                </p>
                <ul class="mt-2 list-disc pl-6 text-bif-muted">
                    <li>Attraktiv bosætningskommune – flere indbyggere og et godt sted at bo</li>
                    <li>Mere gang i erhverv og turisme – flere job og kvalificeret arbejdskraft</li>
                    <li>Forbedring af rammevilkår</li>
                    <li>Dit gode liv – sundhed og velfærd og det at mestre sit eget liv</li>
                </ul>
                <p class="mt-4 leading-relaxed text-bif-muted">
                    Ideen om at udbygge skolens ASF-linje med en sansemotorisk multihal, og et lokalt special-miljø
                    tilpasset familier med børn der ligger inden for autismespektret, modsvarer alle de fire tværgående områder.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md md:p-8">
                <h3 class="text-lg font-semibold">Økonomi og drift</h3>
                <p class="mt-2 leading-relaxed text-bif-muted">
                    Initiativgruppen foreslår den sansemotoriske multihal bygget som et kommunalt projekt drevet af
                    idrætsforeningen lig den eksisterende hal. Initiativgruppen varetager projekteringen i et samarbejde
                    med kommunen, udarbejder fondsansøgninger og leverer frivilligt arbejde i byggeprocessen så vidt det er muligt.
                </p>
            </div>
        </div>
    </div>
</template>
