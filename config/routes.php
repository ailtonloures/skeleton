<?php

$router = new App\Services\Slim();

$router->group('', function () use ($router) {
    require_once __DIR__ . '/../routes/routes.php';
});

$router->group('/api', function () use ($router) {
    require_once __DIR__ . '/../routes/api.php';
});

$router->run();
