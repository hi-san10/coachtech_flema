<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function setting()
    {
        return view('profile_setting');
    }
}
