<?php

return [
    'cache_ttl' => (int) env('CALENDAR_CACHE_TTL', 1800),

    'conventus' => [
        'rss_url' => env(
            'CONVENTUS_CALENDAR_RSS_URL',
            'https://www.conventus.dk/dataudv/www/kalender_rss.php?foreningsid=2266&type_ikon=1&mos=1&dato=1&dato_tidspunkt=1&titel=1&sted=1&klikbar=1&tid=2&niveau=1&gruppe_type=2&rss=1&typo_dato_tid=14744&typo_titel=6413&typo_sted=14745'
        ),
    ],
];
