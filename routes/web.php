<?php

use App\Http\Controllers\Controller;
use App\Http\Views\ListAndCreateView;

/** @var \App\Providers\SlimProvider $app */

$app->get('/', Controller::class .':index');

$app->map(['GET', 'POST'], '/view', ListAndCreateView::class . ':asView');