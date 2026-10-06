<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import PageHero from '@/components/PageHero.vue';
import { Head } from '@inertiajs/vue3';
import { Clock, MapPin, Trophy, CalendarDays } from 'lucide-vue-next';
import { computed } from 'vue';

defineOptions({ layout: MainLayout });

interface CalendarEvent {
    id: string;
    title: string;
    starts_at: string;
    location: string | null;
    url: string | null;
    source: string;
    type: string | null;
}

const props = defineProps<{ events: CalendarEvent[] }>();

const locale = 'da-DK';

const monthLabel = (date: Date) => {
    const label = date.toLocaleDateString(locale, { month: 'long', year: 'numeric' });
    return label.charAt(0).toUpperCase() + label.slice(1);
};

const weekday = (date: Date) => date.toLocaleDateString(locale, { weekday: 'short' }).replace('.', '');
const time = (date: Date) => date.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit' });

const months = computed(() => {
    const groups = new Map<string, { label: string; events: (CalendarEvent & { date: Date })[] }>();

    for (const event of props.events) {
        const date = new Date(event.starts_at);
        const key = `${date.getFullYear()}-${date.getMonth()}`;
        if (!groups.has(key)) {
            groups.set(key, { label: monthLabel(date), events: [] });
        }
        groups.get(key)!.events.push({ ...event, date });
    }

    return [...groups.values()];
});
</script>

<template>
    <Head title="Kalender" />
    <PageHero title="Kalender" subtitle="Kommende begivenheder og aktiviteter" />

    <div class="px-4 py-12 md:py-16">
        <div class="mx-auto max-w-5xl space-y-10">
            <div v-if="months.length === 0" class="flex flex-col items-center rounded-xl bg-white p-12 text-center shadow-md">
                <CalendarDays class="h-10 w-10 text-bif-muted" />
                <p class="mt-4 text-bif-muted">Der er ingen kommende begivenheder i kalenderen.</p>
            </div>

            <section v-for="month in months" :key="month.label">
                <h2 class="mb-4 text-xl font-bold md:text-2xl">{{ month.label }}</h2>
                <ul class="divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-md">
                    <li v-for="event in month.events" :key="event.id">
                        <component
                            :is="event.url ? 'a' : 'div'"
                            :href="event.url ?? undefined"
                            :target="event.url ? '_blank' : undefined"
                            :rel="event.url ? 'noopener' : undefined"
                            class="flex gap-4 p-4 transition md:items-center md:gap-6 md:p-5"
                            :class="event.url ? 'hover:bg-bif-accent/5' : ''"
                        >
                            <div class="flex w-14 shrink-0 flex-col items-center rounded-lg bg-bif-accent/10 py-2 text-bif-accent">
                                <span class="text-xs font-medium uppercase">{{ weekday(event.date) }}</span>
                                <span class="text-2xl font-bold leading-tight">{{ event.date.getDate() }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-medium leading-snug">{{ event.title }}</p>
                                <div class="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-sm text-bif-muted">
                                    <span class="inline-flex items-center gap-1">
                                        <Clock class="h-4 w-4" /> {{ time(event.date) }}
                                    </span>
                                    <span v-if="event.location" class="inline-flex items-center gap-1">
                                        <MapPin class="h-4 w-4" /> {{ event.location }}
                                    </span>
                                    <span v-if="event.type === 'kamp'" class="inline-flex items-center gap-1">
                                        <Trophy class="h-4 w-4" /> Kamp
                                    </span>
                                </div>
                            </div>
                        </component>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</template>
