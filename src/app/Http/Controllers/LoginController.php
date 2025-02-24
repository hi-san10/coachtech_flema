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
use App\Models\Profile;

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
        $password = $request->password;

        User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        Mail::to($email)->send(new VerifyMail($email));

        return view('/verification_email', compact('email', 'password'));
    }

    public function resend(Request $request)
    {
        $email = $request->verification_email;
        Mail::to($email)->send(new VerifyMail($email));

        return view('/verification_email', compact('email'));
    }

    public function certification(Request $request)
    {
        User::where('email', $request->email)->update(['email_verified_at' => CarbonImmutable::today()]);

        $credentials = ([
            'email' => $request->email,
            'password' => $request->password
        ]);
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('setting');
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
        }elseif(is_null($user->email_verified_at))
        {
            return back()->with('message', 'ユーザー認証がお済みではありません');
        }
        $credentials = ([
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::attempt($credentials);
        $request->session()->regenerate();

        if(Profile::where('user_id', $user->id)->exists())
        {
            return redirect('/');
        }

        return redirect('/mypage/profile');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
