@extends('layouts/register_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="flema-register">
    <div class="register-content">
        <h1>会員登録</h1>
        <form class="register__form" action="/verification_email/sent" method="post">
            @csrf
            <div class="form-inner">
                <p class="inner__txt">ユーザー名</p>
                <input class="inner__input" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p class="inner__txt">メールアドレス</p>
                <input class="inner__input" type="email" name="email" value="{{ old('email') }}">
                @error('email')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p class="inner__txt">パスワード</p>
                <input class="inner__input" type="password" name="password">
                @error('password')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p class="inner__txt">確認用パスワード</p>
                <input class="inner__input" type="password" name="password_confirmation">
                @error('password_confirmation')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <button class="inner__btn">登録する</button>
            </div>
        </form>
        <a class="login__link" href="/login">ログインはこちら</a>
    </div>
</div>
@endsection