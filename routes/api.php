<?php

use App\Services\Response;

$router->get('', function($req, Response $res) {
   return $res->json('Hello world');
});
