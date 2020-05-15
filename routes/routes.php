<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;

/** @var \App\Services\Slim $router */

$router->get('/', Controller::class .':index')->setName('index');
$router->get('/teste', Controller::class . ':teste')->setName('teste');

$router->group('/oauth', function() use ($router) {
    $router->get('/google', AuthController::class . ':googleLogin');
});