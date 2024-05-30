<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return inertia(
            'index/index',
            ['message' => 'hello from laravel']
    );


    }

    public function show()
    {
        return inertia('index/show');

    }
}
