<?php

namespace Dev\Test;

class TestCase extends \PHPUnit\Framework\TestCase {
	protected $app;
	protected $db;

	protected function setUp () {
		require __DIR__ . '/../src/bootstrap.php';

		$this->app	= $app;
		$this->db	= $container->db;
	}

	protected function process ($request, $response) {
		return $this->app->process($request, $response);
	}

	protected function request($method, $uri, $options = []) {
		$environment = \Slim\Http\Environment::mock(array_merge([
			'REQUEST_METHOD'	=> $method,
			'REQUEST_URI'	=> $uri
		], $options));

		$request	= \Slim\Http\Request::createFromEnvironment($environment);
		$response	= new \Slim\Http\Response();

		return $this->process($request, $response);
	}

	protected function get($uri, $options = []) {
		return $this->request('GET', $uri, $options);
	}

	protected function post($uri, $options = []) {
		return $this->request('POST', $uri, $options);
	}
}
