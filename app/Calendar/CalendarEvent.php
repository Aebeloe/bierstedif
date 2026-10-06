<?php

namespace App\Calendar;

use Carbon\CarbonImmutable;

final readonly class CalendarEvent
{
    public function __construct(
        public string $id,
        public string $title,
        public CarbonImmutable $startsAt,
        public ?string $location,
        public ?string $url,
        public string $source,
        public ?string $type = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'starts_at' => $this->startsAt->toIso8601String(),
            'location' => $this->location,
            'url' => $this->url,
            'source' => $this->source,
            'type' => $this->type,
        ];
    }
}
