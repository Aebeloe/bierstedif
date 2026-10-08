<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ShiftEventTest extends TestCase
{
    use RefreshDatabase;

    private function makeShift(string $event, string $name): Shift
    {
        return Shift::create([
            'event' => $event,
            'name' => $name,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHours(2),
            'group_id' => (string) \Illuminate\Support\Str::uuid(),
        ]);
    }

    public function test_public_pages_only_list_shifts_for_their_own_event(): void
    {
        Setting::set('mosefesten_public', '1');
        Setting::set('julehop_public', '1');
        $this->makeShift('mosefesten', 'Bar');
        $this->makeShift('julehop', 'Gløgg');

        $this->get('/tilmeldinger/mosefesten')->assertInertia(fn (Assert $page) => $page
            ->component('Tilmeldinger/Mosefesten', false)
            ->has('shifts', 1)
            ->where('shifts.0.name', 'Bar'));

        $this->get('/tilmeldinger/julehop')->assertInertia(fn (Assert $page) => $page
            ->component('Tilmeldinger/Julehop', false)
            ->has('shifts', 1)
            ->where('shifts.0.name', 'Gløgg'));
    }

    public function test_julehop_visibility_is_independent_of_mosefesten(): void
    {
        Setting::set('mosefesten_public', '1');

        $this->get('/tilmeldinger/mosefesten')->assertOk();
        $this->get('/tilmeldinger/julehop')->assertNotFound();

        $this->actingAs(User::factory()->create())->post('/dashboard/toggle-visibility/julehop');

        $this->get('/tilmeldinger/julehop')->assertOk();
    }

    public function test_unknown_event_cannot_be_toggled(): void
    {
        $this->actingAs(User::factory()->create())
            ->post('/dashboard/toggle-visibility/paaskefrokost')
            ->assertNotFound();
    }

    public function test_store_assigns_shifts_to_the_given_event(): void
    {
        $this->actingAs(User::factory()->create())->post('/shifts', [
            'event' => 'julehop',
            'name' => 'Æbleskiver',
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDay()->addHour()->toDateTimeString(),
            'quantity' => 2,
        ])->assertRedirect();

        $this->assertSame(2, Shift::where('event', 'julehop')->count());
    }

    public function test_dashboard_exposes_visibility_per_event(): void
    {
        Setting::set('julehop_public', '1');

        $this->actingAs(User::factory()->create())->get('/dashboard')->assertInertia(fn (Assert $page) => $page
            ->where('publicEvents.mosefesten', false)
            ->where('publicEvents.julehop', true));
    }
}
