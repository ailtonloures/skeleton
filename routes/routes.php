<?php

use App\Http\Controllers\Controller;
use App\Http\Views\ListAndCreateView;

/** @var \App\Providers\SlimProvider $router */

$router->get('/', Controller::class .':index');

$router->map(['GET', 'POST'], '/view', ListAndCreateView::class . ':asView');