<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ShiftController extends Controller
{
    public static function isPublic(string $event): bool
    {
        return Setting::get("{$event}_public", '0') === '1';
    }

    public function publicIndex(string $event, string $component)
    {
        if (! Auth::check() && ! self::isPublic($event)) {
            abort(404);
        }

        $shifts = Shift::where('event', $event)
            ->where('start_time', '>=', now()->startOfDay())
            ->orderBy('start_time')
            ->get();

        $grouped = $shifts->groupBy(fn (Shift $s) => $s->group_id)->map(function ($group) {
            $first = $group->first();
            $unclaimed = $group->first(fn (Shift $s) => ! $s->isClaimed());
            $claimedNames = $group->filter(fn (Shift $s) => $s->isClaimed())
                ->map(fn (Shift $s) => $s->volunteer_name
                    ? explode(' ', $s->volunteer_name)[0]
                    : ($s->assignee?->name ? explode(' ', $s->assignee->name)[0] : null)
                )->filter()->values();

            return [
                'id' => $unclaimed?->id ?? $first->id,
                'name' => $first->name,
                'description' => $first->description,
                'category' => $first->category,
                'start_time' => $first->start_time->toIso8601String(),
                'end_time' => $first->end_time->toIso8601String(),
                'total' => $group->count(),
                'claimed' => $group->filter(fn (Shift $s) => $s->isClaimed())->count(),
                'available' => $group->filter(fn (Shift $s) => ! $s->isClaimed())->count(),
                'claimed_names' => $claimedNames,
            ];
        })->filter(fn ($group) => $group['available'] > 0)->values();

        return Inertia::render($component, [
            'shifts' => $grouped,
        ]);
    }

    public function claim(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            'volunteer_name' => ['required', 'string', 'max:255'],
            'volunteer_contact' => ['required', 'string', 'max:255'],
        ]);

        if ($shift->isClaimed()) {
            return redirect()->back()->withErrors(['shift' => 'Denne vagt er allerede taget.']);
        }

        $shift->update($validated);

        return redirect()->back();
    }

    public function dashboardShifts()
    {
        $shifts = Shift::with('assignee')->orderBy('start_time')->get();

        $grouped = $shifts->groupBy(fn (Shift $s) => $s->group_id)->map(function ($group) {
            $first = $group->first();

            $volunteers = $group->filter(fn (Shift $s) => $s->isClaimed())
                ->map(fn (Shift $s) => [
                    'shift_id' => $s->id,
                    'name' => $s->volunteer_name ?? $s->assignee?->name,
                    'contact' => $s->volunteer_contact ?? '',
                ])->filter(fn ($v) => $v['name'])->values();

            return [
                'group_id' => $first->group_id,
                'event' => $first->event,
                'name' => $first->name,
                'description' => $first->description,
                'category' => $first->category,
                'start_time' => $first->start_time->toIso8601String(),
                'end_time' => $first->end_time->toIso8601String(),
                'total' => $group->count(),
                'claimed' => $volunteers->count(),
                'available' => $group->filter(fn (Shift $s) => ! $s->isClaimed())->count(),
                'volunteers' => $volunteers,
                'shift_ids' => $group->pluck('id')->values(),
            ];
        })->values();

        return $grouped;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event' => ['required', Rule::in(Shift::EVENTS)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);

        $groupId = (string) Str::uuid();

        for ($i = 0; $i < $validated['quantity']; $i++) {
            Shift::create([
                'event' => $validated['event'],
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'category' => $validated['category'] ?? null,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'group_id' => $groupId,
            ]);
        }

        return redirect()->back();
    }

    public function updateGroup(Request $request, string $groupId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'category' => ['nullable', 'string', 'max:255'],
            'add' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        $add = $validated['add'] ?? 0;
        unset($validated['add']);

        Shift::where('group_id', $groupId)->update($validated);

        for ($i = 0; $i < $add; $i++) {
            Shift::create([
                ...$validated,
                'group_id' => $groupId,
            ]);
        }

        return redirect()->back();
    }

    public function unclaim(Shift $shift)
    {
        $shift->update([
            'user_id' => null,
            'volunteer_name' => null,
            'volunteer_contact' => null,
        ]);

        return redirect()->back();
    }

    public function toggleVisibility(string $event)
    {
        abort_unless(in_array($event, Shift::EVENTS, true), 404);

        Setting::set("{$event}_public", self::isPublic($event) ? '0' : '1');

        return redirect()->back();
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->back();
    }
}
