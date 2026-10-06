<?php

namespace App\Calendar\Sources;

use App\Calendar\CalendarEvent;
use App\Calendar\EventSource;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use SimpleXMLElement;

class ConventusRssSource implements EventSource
{
    public function __construct(private readonly string $feedUrl) {}

    public function name(): string
    {
        return 'conventus';
    }

    public function events(): Collection
    {
        $response = Http::timeout(10)->get($this->feedUrl)->throw();

        $xml = @simplexml_load_string($response->body());
        if ($xml === false) {
            throw new RuntimeException('Conventus feed is not valid XML');
        }

        return collect($xml->xpath('//item') ?: [])
            ->map(fn (SimpleXMLElement $item) => $this->toEvent($item))
            ->filter()
            ->values();
    }

    private function toEvent(SimpleXMLElement $item): ?CalendarEvent
    {
        $title = trim((string) $item->title);
        $pubDate = trim((string) $item->pubDate);
        if ($title === '' || $pubDate === '') {
            return null;
        }

        // Conventus keeps the summer offset (+0200) on dates after the DST switch,
        // so the wall-clock time is right but the offset is not. Use the wall-clock time as local.
        $startsAt = CarbonImmutable::parse($pubDate)->shiftTimezone(config('app.timezone'));
        $fields = $this->parseDescription((string) $item->description);
        $link = trim((string) $item->link) ?: null;

        return new CalendarEvent(
            id: $this->name().':'.(trim((string) $item->guid) ?: md5($title.$pubDate)),
            title: $title,
            startsAt: $startsAt,
            location: $fields['Sted'] ?? null,
            url: $link,
            source: $this->name(),
            type: $link && str_contains($link, 'vis_kamp') ? 'kamp' : 'aftale',
        );
    }

    /**
     * The description is "Key: Value<br />" lines.
     *
     * @return array<string, string>
     */
    private function parseDescription(string $description): array
    {
        $fields = [];
        foreach (preg_split('/<br\s*\/?>/i', $description) as $line) {
            $line = trim(html_entity_decode($line, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            if ($line === '' || ! str_contains($line, ':')) {
                continue;
            }
            [$key, $value] = explode(':', $line, 2);
            $value = trim($value);
            if ($value !== '') {
                $fields[trim($key)] = $value;
            }
        }

        return $fields;
    }
}
