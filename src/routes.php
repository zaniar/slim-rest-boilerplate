<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("route '/'");

	$data = ['message' => 'Welcome'];

	return $response->withJson($data);
});
