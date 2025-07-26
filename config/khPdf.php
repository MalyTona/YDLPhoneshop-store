<?php

return [
    'pdf' => [
        'font_path' => public_path('fonts/'),

        'font_data' => [
            'battambang' => [
                'R' => 'khmerOSbattambang.ttf',
                'useOTL' => true,
            ],
            'khmermuol' => [
                'R' => 'khmerOSmuol.ttf',
                'useOTL' => true,
            ],
            'roboto' => [
                'R' => 'Roboto-Regular.ttf',
                'B' => 'Roboto-Bold.ttf',
            ]
        ],

        'default_config' => [
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 12,
            'default_font' => 'battambang',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P',
            'useSubstitutions' => true,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ],
    ],
];
