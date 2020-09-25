<?php

namespace App\Http\Controllers;

use App\Services\Response;
use Slim\Http\Request;

class Controller
{
    public function index()
    {
        return response()->view('home', [
            'msg' => 'Hello World'
        ]);
    }
}
