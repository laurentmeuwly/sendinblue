<?php

// API KEY test lmeuwly:
// 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
return [
    'apikey' => env('SENDINBLUE_APIKEY', ''),
    'base_url' => 'https://api.sendinblue.com/v3/',

    'attributes' => [
        'CIVILITE' => [
            '1' => 'Monsieur',
            '2' => 'Madame',
            '3' => 'Herr',
            '4' => 'Frau',
            '5' => 'Mister',
            '6' => 'Madam'
        ],
        'LANGUE' => [
            '1' => 'FR',
            '2' => 'DE',
            '3' => 'EN'
        ]
    ]
];