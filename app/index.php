<?php require 'vendor/autoload.php';

// Initiate the APP object
$app = new \Slim\App();

// Declare routes
$app->get('/location/{id}', function ($req, $res, $args){
    return $res->withStatus(200)->write("Location {$args['id']}");
});

$app->delete('/location/{id}', function ($req, $res, $args){
    return $res->withStatus(200)->write("Location {$args['id']}");
});

// run the application
$app->run();