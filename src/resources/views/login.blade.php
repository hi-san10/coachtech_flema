@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="flema-login">
    <div class="login-content">
        <h1>ログイン</h1>
        @if(session('verify_message'))
        <div class="session__message">{{ session('verify_message') }}</div>
        @endif
        <form action="/login" method="post">
            @csrf
            <div class="form-inner">
                <p class="inner__txt">ユーザー名/メールアドレス</p>
                <input type="email" name="email">
                @error('email')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p class="inner__txt">パスワード</p>
                <input type="password" name="password">
                @error('password')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            @if(session('message'))
            <div class="session__message">{{ session('message') }}</div>
            @endif
            <div class="form-inner">
                <button>ログインする</button>
            </div>
        </form>
            <a class="register__link" href="/register">会員登録はこちら</a>
    </div>
</div>
@endsection