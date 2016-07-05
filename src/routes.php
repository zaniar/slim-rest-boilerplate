<?php
// Routes

$app->get('/', function ($request, $response, $args) {
	// Sample log message
	$this->logger->info("route '/'");

	$output = ['message' => 'Welcome'];

	return $response->withJson($output);
});

$app->group('/user', function() {
	$this->get('', function ($request, $response, $args) {
		$this->logger->info("route GET '/user'");

		$output = [];
		foreach ($this->db->user() as $user) {
			$output[] = $user;
		}

		return $response->withJson($output);
	});
	$this->post('', function ($request, $response, $args) {
		$input = $request->getParsedBody();

		$row = $this->db->user()->insert($input);

		$output = [
			'id' => $row['id']
		];

		return $response->withJson($output);
	});
});
