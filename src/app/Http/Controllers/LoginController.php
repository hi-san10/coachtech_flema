<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login_top()
    {
        return view('login');
    }

    public function register_top()
    {
        return view('register');
    }
}
