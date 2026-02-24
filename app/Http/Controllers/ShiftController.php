<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
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

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->back();
    }
}
