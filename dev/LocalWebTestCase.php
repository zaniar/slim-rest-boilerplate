<?php

namespace Dev\Test;

require 'vendor/autoload.php';

use PHPUnit;
use GuzzleHttp;

class TestCase extends PHPUnit\Framework\TestCase {
	protected $client;

	protected function setUp() {
		$this->client = new GuzzleHttp\Client([
			'base_uri' => 'http://localhost:8000',
			'http_errors' => false
		]);
	}
}
