<?php

namespace Tests\Feature;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class KalenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        CarbonImmutable::setTestNow('2026-10-01 12:00:00');
    }

    protected function tearDown(): void
    {
        CarbonImmutable::setTestNow();
        parent::tearDown();
    }

    public function test_it_lists_upcoming_conventus_events_sorted_by_start(): void
    {
        Http::fake(['www.conventus.dk/*' => Http::response(file_get_contents(base_path('tests/Fixtures/conventus_rss.xml')), 200)]);

        $this->get('/kalender')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Kalender', false)
                ->has('events', 7)
                ->where('events.0.title', '2026 Efterår: U14 drenge (årgang 2013) mod Aars IK')
                ->where('events.0.starts_at', '2026-10-06T18:00:00+02:00')
                ->where('events.0.location', 'Biersted Stadion')
                ->where('events.0.url', 'https://www.conventus.dk/dataudv/www/vis_kamp.php?id=565197')
                ->where('events.0.type', 'kamp')
                ->where('events.0.source', 'conventus')
                ->where('events.6.starts_at', '2026-10-26T19:00:00+01:00')
            );
    }

    public function test_it_hides_past_events(): void
    {
        CarbonImmutable::setTestNow('2026-10-20 12:00:00');
        Http::fake(['www.conventus.dk/*' => Http::response(file_get_contents(base_path('tests/Fixtures/conventus_rss.xml')), 200)]);

        $this->get('/kalender')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->has('events', 4)
                ->where('events.0.starts_at', '2026-10-20T18:00:00+02:00')
            );
    }

    public function test_it_renders_empty_calendar_when_source_fails(): void
    {
        Http::fake(['www.conventus.dk/*' => Http::response('', 500)]);

        $this->get('/kalender')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->has('events', 0));
    }
}
