<?php
// DIC configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// http client
$container['client'] = function ($c) {
	$client = new GuzzleHttp\Client();

	return $client;
};

// database
$container['db'] = function ($c) {
	$settings = $c->get('settings')['db'];

	$dsn;
	switch($settings['adapter']) {
		case 'sqlite':
			$dsn = 'sqlite:';
			if ($settings['memory'] === true) {
				$dsn .= ':memory:';
			} else {
				if (substr($settings['name'], 0) !== '/') {
					$dsn .= __DIR__ . '/../';
				}
				$dsn .= $settings['name'];
			}
		break;
	}

	$c->logger->info($dsn);
	$pdo = new PDO($dsn);

	$db = new NotORM($pdo);
	return $db;
};
