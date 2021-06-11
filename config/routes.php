<?php

$app = new App\Providers\AppProvider();

$app->group('', function () use ($app) {
    require_once __DIR__ . '/../routes/web.php';
});

$app->group('/api', function () use ($app) {
    require_once __DIR__ . '/../routes/api.php';
});

$app->run();