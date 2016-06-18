<?php

$environment = 'development';

$db = [
	'development' => [
		'adapter' => 'sqlite',
		'name' => 'data/development.db',
		'memory' => true,
	],
	'production' => [
	],
];

return [
    'settings' => [
		'environment' => $environment,
        'displayErrorDetails' => true, // set to false in production

        // Monolog settings
        'logger' => [
            'name' => 'slim-rest',
            'path' => __DIR__ . '/../logs/app.log',
        ],

		// Database settting
		'db' => $db[$environment]
    ],
];
