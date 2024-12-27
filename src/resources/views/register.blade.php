@extends('layouts/register_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="flema-register">
    <div class="register-content">
        <h1>会員登録</h1>
        <form action="/register" method="post">
            @csrf
            <div class="form-inner">
                <p class="inner__txt">ユーザー名</p>
                <input type="text" name="name">
                @error('name')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p class="inner__txt">メールアドレス</p>
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
            <div class="form-inner">
                <p class="inner__txt">確認用パスワード</p>
                <input type="password" name="password_confirmation">
                @error('password')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <button>登録する</button>
            </div>
        </form>
        <a class="login__link" href="/login_top">ログインはこちら</a>
    </div>
</div>
@endsection