<?php

return [
    'links' => [
        ['icono' => '👥', 'label' => 'Contactos',  'href' => env('NAV_CONTACTOS',  'http://10.60.200.8/MSI1N/complementos/contactos.html')],
        ['icono' => '🔼', 'label' => 'Escalación',  'href' => env('NAV_ESCALACION', 'http://10.60.200.8/MSI1N/complementos/index.html')],
        ['icono' => '📋', 'label' => 'TIDEL',       'href' => env('NAV_TIDEL',      'http://10.60.200.8/MSI1N/tidel/tidel.php')],
        ['icono' => '📑', 'label' => 'RITM',        'href' => env('NAV_RITM',       'http://10.60.200.8/MSI1N/ritms/listaRitm.php')],
    ],
];
