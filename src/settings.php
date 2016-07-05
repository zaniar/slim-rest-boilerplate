<?php

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$db = [
	'development' => [
		'adapter'	=> 'sqlite',
		'name'	=> 'db/development.db',
	],
	'test' => [
		'adapter'	=> 'sqlite',
		'memory'	=> true
	]
];

$env_opts = explode(';', getenv('ENV_OPTS'));
foreach ($env_opts as $env) {
	$env = strtolower($env);

	if (!isset($db[$env]))
		$db[$env] = [];

	$props = ['adapter', 'host', 'name', 'user', 'pass', 'port', 'charset', 'unix_socket', 'memory'];
	foreach ($props as $prop) {
		$dotenv_name = 'DB_' . strtoupper($env) . '_' . strtoupper($prop);
		$value = getenv($dotenv_name);

		if (!$value)
			continue;

		$db[$env][$prop] = $value;
	}
}

$app_env = !empty(getenv('APP_ENV')) ? getenv('APP_ENV') : 'development';

return [
	'settings' => [
		'displayErrorDetails' => $app_env !== 'production', // set to false in production
		'environment' => $app_env,

		// Monolog settings
		'logger' => [
			'name'	=> 'slim-rest',
			'path'	=> __DIR__ . '/../logs/app.log',
		],

		// Database settting
		'db' => $db[$app_env]
	]
];
