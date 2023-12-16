<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() 
    {

        // dd(Auth::user()); // get authenticated user
        // dd(Auth::check()); // check if user is authenticated
        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from Laravel'
            ]
        );
    }

    public function show() 
    {
        return inertia('Index/Show');
    }
}
