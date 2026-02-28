<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ShiftController extends Controller
{
    public function mosefestenIndex()
    {
        if (! Auth::check() && Setting::get('mosefesten_public', '0') !== '1') {
            abort(404);
        }

        $shifts = Shift::where('start_time', '>=', now()->startOfDay())
            ->orderBy('start_time')
            ->get();

        // Group identical shifts (same name, description, start_time, end_time)
        $grouped = $shifts->groupBy(fn (Shift $s) =>
            $s->name.'|'.$s->description.'|'.$s->start_time->toIso8601String().'|'.$s->end_time->toIso8601String()
        )->map(function ($group) {
            $first = $group->first();
            $unclaimed = $group->first(fn (Shift $s) => !$s->isClaimed());
            $claimedNames = $group->filter(fn (Shift $s) => $s->isClaimed())
                ->map(fn (Shift $s) => $s->volunteer_name
                    ? explode(' ', $s->volunteer_name)[0]
                    : ($s->assignee?->name ? explode(' ', $s->assignee->name)[0] : null)
                )->filter()->values();

            return [
                'id' => $unclaimed?->id ?? $first->id,
                'name' => $first->name,
                'description' => $first->description,
                'start_time' => $first->start_time->toIso8601String(),
                'end_time' => $first->end_time->toIso8601String(),
                'total' => $group->count(),
                'claimed' => $group->filter(fn (Shift $s) => $s->isClaimed())->count(),
                'available' => $group->filter(fn (Shift $s) => !$s->isClaimed())->count(),
                'claimed_names' => $claimedNames,
            ];
        })->filter(fn ($group) => $group['available'] > 0)->values();

        return Inertia::render('Tilmeldinger/Mosefesten', [
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

        $grouped = $shifts->groupBy(fn (Shift $s) =>
            $s->name.'|'.$s->description.'|'.$s->start_time->toIso8601String().'|'.$s->end_time->toIso8601String()
        )->map(function ($group) {
            $first = $group->first();

            $volunteers = $group->filter(fn (Shift $s) => $s->isClaimed())
                ->map(fn (Shift $s) => [
                    'name' => $s->volunteer_name ?? $s->assignee?->name,
                    'contact' => $s->volunteer_contact ?? '',
                ])->filter(fn ($v) => $v['name'])->values();

            return [
                'name' => $first->name,
                'description' => $first->description,
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        for ($i = 0; $i < $validated['quantity']; $i++) {
            Shift::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
        }

        return redirect()->back();
    }

    public function toggleMosefesten()
    {
        $current = Setting::get('mosefesten_public', '0');
        Setting::set('mosefesten_public', $current === '1' ? '0' : '1');

        return redirect()->back();
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->back();
    }
}
