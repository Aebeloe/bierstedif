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
        $dir = public_path('images-sponsorer');
        $sponsors = [];

        if (is_dir($dir)) {
            foreach (scandir($dir) as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'svg', 'webp'])) {
                    $name = pathinfo($file, PATHINFO_FILENAME);
                    $url = null;

                    // If filename looks like a URL (contains a dot-separated domain pattern)
                    if (preg_match('/^(www\.)?[a-z0-9-]+\.[a-z]{2,}/i', $name)) {
                        $url = 'https://' . $name;
                    }

                    $sponsors[] = [
                        'image' => '/images-sponsorer/' . $file,
                        'name' => $name,
                        'url' => $url,
                    ];
                }
            }
        }

        return Inertia::render('Sponsorer', ['sponsors' => $sponsors]);
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
