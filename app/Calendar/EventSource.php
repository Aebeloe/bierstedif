<?php

namespace App\Calendar;

use Illuminate\Support\Collection;

interface EventSource
{
    public function name(): string;

    /**
     * @return Collection<int, CalendarEvent>
     */
    public function events(): Collection;
}
