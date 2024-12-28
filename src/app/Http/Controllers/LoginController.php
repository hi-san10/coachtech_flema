<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Carbon\CarbonImmutable;

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
        $email = $request->email;
        User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password)
        ]);
        Mail::to($email)->send(new VerifyMail($email));

        return view('thanks');
    }

    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $email_verified_at = $user->email_verified_at;
        if(is_null($email_verified_at))
        {
            User::where('email', $request->email)->update(['email_verified_at' => CarbonImmutable::today()]);
            return redirect('/login')->with('verify_message', 'ユーザー認証が完了しました');
        }
        return redirect('/login')->with('verify_message', 'ユーザー認証はお済みです');
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
