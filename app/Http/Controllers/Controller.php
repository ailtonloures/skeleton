<?php

namespace App\Http\Controllers;

class Controller
{
    public function index()
    {
        return response()->view('home', [
            'msg' => 'Hello World'
        ]);
    }
}
