<?php

use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__ . './utils.php';

// Routes

$app->get('/hello', function ($request, $response, $args) {
	return $response->withJson([ 'message' => 'Hello !!' ]);
}); 

$app->get('/students/{id}', function ($request, $response, $args) {
	$route = $request->getAttribute('route');
	$studentID = $route->getArgument('id');

	$sql = "
		SELECT *
		FROM `STUDENT_9`
		WHERE `id` = '$studentID'
	";

	$studentState = $this->pdo->query($sql);
	$studentData = $studentState ->fetchAll();
	
	return $response->withJson([ 'studentData' => $studentData ]);
});

$app->post('/sum', function ($request, $response, $args) {
	$parsedBody = $request->getParsedBody();
	
	$numbersArray = $parsedBody['numbers']; 
	
	$sum = 0;
	foreach ($numbersArray as $number) {
		$sum += $number;
	}
	return $response->withJson([ 'sum' => $sum ]);
});
