<?php

$settings = (require 'src/settings.php')['settings'];

return [
	'paths' => [
		'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
		'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
	],
	
	'environments' => [
		'default_migration_table' => 'phinxlog',
		'default_database' => $settings['environment'],
		$settings['environment'] => $settings['db']
	]
];
