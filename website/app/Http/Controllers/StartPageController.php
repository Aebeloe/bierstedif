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
            'menuData' => [
                'Udvalg' => [
                    ['label' => 'Fodbold', 'url' => '/udvalg/fodbold'],
                    ['label' => 'Håndbold', 'url' => '/udvalg/haandbold'],
                    ['label' => 'Gymnastik', 'url' => '/udvalg/gymnastik'],
                    ['label' => 'Badminton', 'url' => '/udvalg/badminton'],
                ],
                'Om Foreningen' => [
                    ['label' => 'Vedtægter', 'url' => '/om/vedtaegter'],
                    ['label' => 'Bestyrelsen', 'url' => '/om/bestyrelsen'],
                    ['label' => 'Privatlivspolitik', 'url' => '/om/privatliv'],
                ],
                // Add other keys as needed...
            ]
        ]);
    }
}
