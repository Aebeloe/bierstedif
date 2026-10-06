<?php

namespace App\Calendar;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class CalendarService
{
    /**
     * @param  iterable<EventSource>  $sources
     */
    public function __construct(private readonly iterable $sources) {}

    /**
     * Upcoming events from all sources, sorted by start time.
     *
     * @return Collection<int, CalendarEvent>
     */
    public function upcoming(): Collection
    {
        $events = collect();

        foreach ($this->sources as $source) {
            $events = $events->merge($this->eventsFrom($source));
        }

        return $events
            ->filter(fn (CalendarEvent $event) => $event->startsAt->isFuture() || $event->startsAt->isToday())
            ->sortBy(fn (CalendarEvent $event) => $event->startsAt->timestamp)
            ->values();
    }

    /**
     * Each source is cached separately so one failing source does not hide the others.
     *
     * @return Collection<int, CalendarEvent>
     */
    private function eventsFrom(EventSource $source): Collection
    {
        try {
            return Cache::remember(
                'calendar.source.'.$source->name(),
                config('calendar.cache_ttl'),
                fn () => $source->events(),
            );
        } catch (Throwable $e) {
            Log::warning('Calendar source failed', ['source' => $source->name(), 'error' => $e->getMessage()]);

            return collect();
        }
    }
}
