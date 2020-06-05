<?php

/** @var \App\Providers\SlimProvider $router */

$router->get('', function() {
   return response()->json('Hello world');
});
