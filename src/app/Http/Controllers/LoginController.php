<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

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

    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/mypage/profile');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(is_null($user))
        {
            return back()->with('message', 'ログイン情報が登録されていません。');
        }

        $credentials = ([
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
