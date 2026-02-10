<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('Home');
    }

    public function omForeningen(): Response
    {
        return Inertia::render('OmForeningen');
    }

    public function kalender(): Response
    {
        return Inertia::render('Kalender');
    }

    public function kontakt(): Response
    {
        return Inertia::render('Kontakt');
    }

    public function klubdragt(): Response
    {
        return Inertia::render('Klubdragt');
    }

    public function sponsorer(): Response
    {
        return Inertia::render('Sponsorer');
    }

    public function tilmelding(string $page): Response
    {
        return Inertia::render("Tilmeldinger/{$page}");
    }

    public function udvalgPage(string $page): Response
    {
        return Inertia::render("Udvalg/{$page}");
    }
}
