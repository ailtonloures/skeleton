<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Views\ListAndCreateView;

/** @var \App\Providers\SlimProvider $router */

$router->get('/', Controller::class .':index');

$router->map(['GET', 'POST'], '/view', ListAndCreateView::class . ':asView');

$router->group('/oauth', function() use ($router) {
    $router->get('/google', AuthController::class . ':googleLogin');
});