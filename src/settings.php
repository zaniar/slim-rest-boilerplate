<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Monolog settings
        'logger' => [
            'name' => 'slim-rest',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
