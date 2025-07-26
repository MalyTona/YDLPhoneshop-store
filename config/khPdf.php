<?php

return [
    'pdf' => [
        'default_font' => 'khmeros',
        'font_path' => public_path('fonts/'),
        'font_data' => [
            'khmeros' => [
                'R' => 'khmerOS.ttf',
                'useOTL' => 0xFF,
            ],
            'battambang' => [
                'R' => 'khmerOSbattambang.ttf',
                'useOTL' => 0xFF,
            ],
            'khmermuol' => [
                'R' => 'khmerOSmuol.ttf',
                'useOTL' => 0xFF,
            ],
        ],


        // Default mPDF configuration
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
            // Force Unicode support
            'useSubstitutions' => true,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ],
    ],
];
