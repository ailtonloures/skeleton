<?php

$router->get('', function() {
   return response()->json('Hello world');
});
