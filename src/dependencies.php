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

	$adapter	= isset($settings['adapter']) ? $settings['adapter'] : null;
	$host	= isset($settings['host']) ? $settings['host'] : null;
	$name	= isset($settings['name']) ? $settings['name'] : null;
	$user	= isset($settings['user']) ? $settings['user'] : null;
	$pass	= isset($settings['pass']) ? $settings['pass'] : null;
	$port	= isset($settings['port']) ? $settings['port'] : null;
	$charset	= isset($settings['charset']) ? $settings['charset'] : null;
	$unix_socket	= isset($settings['unix_socket']) ? $settings['unix_socket'] : null;
	$memory	= isset($settings['memory']) ? $settings['memory'] : null;

	$dsn;
	switch($adapter) {
		case 'sqlite':
			$dsn = 'sqlite:';
			if (isset($memory)) {
				$dsn .= ':memory:';
			} else if (isset($name)){
				if (substr($name, 0) !== '/') {
					$dsn .= __DIR__ . '/../';
				}
				$dsn .= $name;
			}
		break;
		default:
			$dsn = 'mysql:host='.$host.';dbname='.$name;
	}

	$pdo = new PDO($dsn, $user, $pass);

	$db = new NotORM($pdo);

	return $db;
};
