<?php

namespace App\Http\Controllers;

use App\Services\Response;
use Slim\Http\Request;

class Controller
{
    public function index(Request $request, Response $response)
    {
        $response->addData('msg', "Hello world");

        return $response->view('home');
    }
}
