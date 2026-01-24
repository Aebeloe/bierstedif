<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class StartPageController
{
    public function get()
    {




        return Inertia::render('Welcome', [
            'canRegister' => false,
        ]);
    }
}
