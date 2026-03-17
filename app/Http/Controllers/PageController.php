<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    private const CONVENTUS_IFRAME_URLS = [
        'Badminton' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=8376&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Haandbold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=8378&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Fodbold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=8377&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Esport' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=44611&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'OevrigeHold' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=61674&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Ungdomsklub' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=13707&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Familiemedlemskab' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=7323&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Gymnastik' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=8379&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Floorball' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=8379&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
        'Dart' => 'https://www.conventus.dk/dataudv/www/holdoversigt_ny_iframe.php?foreningsid=2266&afdelingsid=61674&handelsbetingelser=1&reservationer=vis&skjul_nyt_medlem=0&skjul_allerede_medlem=0&raekkefoelge=alfabetisk&vis_adresse=0&knap_placering=horisontal&highlight=pris&start=periode;ledige_pladser&info=tid_sted;alder;betaling;tilmelding;tilmeld_aabner_om;ledere;om_holdet&sprog=auto',
    ];

    // Panel heading filters: 'exclude' hides panels matching keyword, 'include' shows only matching panels
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

    public function dokumenter(): Response
    {
        return Inertia::render('Dokumenter');
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

    private function conventusEmbedUrl(string $page): string
    {
        return route('conventus-embed', $page);
    }

    public function tilmelding(string $page): Response
    {
        $props = [];

        if (isset(self::CONVENTUS_IFRAME_URLS[$page])) {
            $props['conventusUrl'] = $this->conventusEmbedUrl($page);
        }

        return Inertia::render("Tilmeldinger/{$page}", $props);
    }

    public function tilmeldingIndex(): Response
    {
        $sections = [];
        foreach (self::CONVENTUS_IFRAME_URLS as $page => $url) {
            $sections[$page] = $this->conventusEmbedUrl($page);
        }

        return Inertia::render('Tilmeldinger/Index', [
            'sections' => $sections,
        ]);
    }

    public function conventusEmbed(string $page): HttpResponse
    {
        if (! isset(self::CONVENTUS_IFRAME_URLS[$page])) {
            abort(404);
        }

        $scriptUrl = str_replace('holdoversigt_ny_iframe.php', 'holdoversigt_ny.php', self::CONVENTUS_IFRAME_URLS[$page]);
        $filter = self::CONVENTUS_FILTERS[$page] ?? null;

        $filterJs = '';
        if ($filter) {
            $mode = isset($filter['include']) ? 'include' : 'exclude';
            $keyword = addslashes($filter[$mode]);
            $filterJs = <<<JS
            function applyFilter(){
                var panels=document.querySelectorAll('.panel.panel-default');
                panels.forEach(function(p){
                    var heading=p.querySelector('.panel-heading');
                    if(!heading)return;
                    var text=heading.textContent.toLowerCase();
                    var match=text.indexOf('{$keyword}')!==-1;
                    p.style.display=('{$mode}'==='include'?match:!match)?'':'none';
                });
                notifyParent();
            }
            window.addEventListener('load',function(){setTimeout(applyFilter,300);setTimeout(applyFilter,1000);setTimeout(applyFilter,3000);});
            new MutationObserver(applyFilter).observe(document.body,{childList:true,subtree:true});
            JS;
        }

        $html = <<<HTML
        <!DOCTYPE html>
        <html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
        <body style="margin:0;padding:10px;">
        <script src="{$scriptUrl}"></script>
        <script>
        function inv_dis(id){var el=document.getElementById(id);if(el){el.style.display=el.style.display==='none'?'':'none';notifyParent();}}
        function notifyParent(){parent.postMessage({type:'conventus-resize',height:document.body.scrollHeight},'*');}
        new ResizeObserver(notifyParent).observe(document.body);
        window.addEventListener('load',function(){setTimeout(notifyParent,500);setTimeout(notifyParent,2000);});
        {$filterJs}
        </script>
        </body></html>
        HTML;

        return new HttpResponse($html, 200, ['Content-Type' => 'text/html']);
    }

    public function mosefestenBilletEmbed(): HttpResponse
    {
        $scriptUrl = 'https://www.conventus.dk/dataudv/www/billetserie.php?foreningsid=2266&billetserie=20194&boks=1&eks_profil=1&ny_profil=1';

        $html = <<<HTML
        <!DOCTYPE html>
        <html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
        <style>body{margin:0;padding:10px;overflow-x:auto;max-width:100vw;box-sizing:border-box}table,img,div{max-width:100%!important}table{width:100%!important}</style>
        </head>
        <body>
        <script src="{$scriptUrl}"></script>
        <script>
        function notifyParent(){parent.postMessage({type:'conventus-resize-billet',height:document.body.scrollHeight},'*');}
        new ResizeObserver(notifyParent).observe(document.body);
        window.addEventListener('load',function(){setTimeout(notifyParent,500);setTimeout(notifyParent,2000);});
        </script>
        </body></html>
        HTML;

        return new HttpResponse($html, 200, ['Content-Type' => 'text/html']);
    }

    public function udvalgPage(string $page): Response
    {
        return Inertia::render("Udvalg/{$page}");
    }
}
