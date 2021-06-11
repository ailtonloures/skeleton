<?php

/** @var \App\Providers\AppProvider $app */

$app->get('', function() {
   return response()->json('Hello world');
});
