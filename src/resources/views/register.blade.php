@extends('layouts/app')

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
                <p>ユーザー名</p>
                <input type="text" name="name">
                @error('name')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p>メールアドレス</p>
                <input type="email" name="email">
                @error('email')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p>パスワード</p>
                <input type="password" name="password">
                @error('password')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <p>確認用パスワード</p>
                <input type="password" name="password_confirmation">
                @error('password')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-inner">
                <button>登録する</button>
            </div>
        </form>
        <a href="/login">ログインはこちら</a>
    </div>
</div>
@endsection