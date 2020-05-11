<?php

/** @var \App\Services\Slim $router */

$router->get('', function() {
   return response()->json('Hello world');
});
