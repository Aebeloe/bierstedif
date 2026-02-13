<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    private const CONVENTUS_URLS = [
        'Badminton' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=8376&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Haandbold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=8378&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Fodbold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=8377&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Esport' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=44611&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'OevrigeHold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=61674&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Ungdomsklub' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=13707&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Familiemedlemskab' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=7323&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Gymnastik' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=8379&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Floorball' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=8379&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Dart' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny.php?foreningsid=2266&afdelingsid=61674&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
    ];

    // Panel filters: 'exclude' removes panels matching the keyword, 'include' keeps only matching panels
    private const CONVENTUS_FILTERS = [
        'Gymnastik' => ['exclude' => 'floorball'],
        'Floorball' => ['include' => 'floorball'],
        'OevrigeHold' => ['exclude' => 'dart'],
        'Dart' => ['include' => 'dart'],
    ];

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
        $html = Cache::remember('conventus_kalender', 3600, function () {
            $response = Http::get('https://www.conventus.dk/dataudv/www/vis_aktivitet.php', [
                'foreningsid' => 2266,
                'id' => 547412,
            ]);

            if (! $response->successful()) {
                return '';
            }

            return $response->body();
        });

        return Inertia::render('Kalender', ['conventusHtml' => $html]);
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
        $props = [];

        if (isset(self::CONVENTUS_URLS[$page])) {
            $filter = self::CONVENTUS_FILTERS[$page] ?? null;

            $props['conventusHtml'] = Cache::remember(
                "conventus_html_{$page}",
                3600,
                fn () => $this->fetchConventusHtml(self::CONVENTUS_URLS[$page], $filter)
            );
        }

        return Inertia::render("Tilmeldinger/{$page}", $props);
    }

    private function fetchConventusHtml(string $url, ?array $filter = null): string
    {
        $response = Http::get($url);

        if (! $response->successful()) {
            return '';
        }

        $body = $response->body();

        // Extract all document.write('...' + '...' + '...') content
        // Conventus uses string concatenation (e.g. 'ma'+'il'+'to:') to obfuscate emails
        $prefix = "document.write('";
        $start = strpos($body, $prefix);

        if ($start === false) {
            return '';
        }

        $start += strlen($prefix);
        $len = strlen($body);
        $parts = [];
        $pos = $start;

        while ($pos < $len) {
            if ($body[$pos] === '\\') {
                $pos += 2; // skip escaped character
            } elseif ($body[$pos] === "'") {
                // Capture this string segment
                $parts[] = substr($body, $start, $pos - $start);
                $pos++;

                // Skip whitespace and check for '+' concatenation
                while ($pos < $len && ctype_space($body[$pos])) {
                    $pos++;
                }

                if ($pos < $len && $body[$pos] === '+') {
                    $pos++;
                    // Skip whitespace and opening quote of next segment
                    while ($pos < $len && ctype_space($body[$pos])) {
                        $pos++;
                    }
                    if ($pos < $len && $body[$pos] === "'") {
                        $pos++;
                        $start = $pos;
                        continue;
                    }
                }

                break; // End of document.write
            } else {
                $pos++;
            }
        }

        $html = implode('', $parts);
        $html = str_replace("\\'", "'", $html);

        // Remove <script> tags (v-html won't execute them)
        $html = preg_replace('/<script[^>]*>.*?<\/script>/s', '', $html);

        // Apply panel filtering if specified
        if ($filter) {
            // Split HTML at each panel boundary
            $parts = preg_split('/(?=<div class="panel panel-default">)/', $html);
            $preamble = $parts[0]; // styles, wrapper divs, etc.
            $panels = array_slice($parts, 1);

            // Match keyword against panel heading only (not body text)
            $headingContains = function (string $panel, string $keyword): bool {
                if (preg_match('/<div class="panel-heading">.*?<\/div>\s*<\/div>/s', $panel, $m)) {
                    return stripos($m[0], $keyword) !== false;
                }

                return false;
            };

            if (isset($filter['exclude'])) {
                $panels = array_filter($panels, fn ($p) => ! $headingContains($p, $filter['exclude']));
            } elseif (isset($filter['include'])) {
                $panels = array_filter($panels, fn ($p) => $headingContains($p, $filter['include']));
            }

            $html = $preamble . implode('', $panels);
        }

        return $html;
    }

    public function udvalgPage(string $page): Response
    {
        return Inertia::render("Udvalg/{$page}");
    }
}
