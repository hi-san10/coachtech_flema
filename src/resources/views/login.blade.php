@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="flema-login">
    <div class="login-content">
        <h1>ログイン</h1>
        <form action="/login" method="post">
            @csrf
            <div class="form-inner">
                <p>ユーザー名/メールアドレス</p>
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
            @if(session('message'))
            <p>{{ session('message') }}</p>
            @endif
            <div class="form-inner">
                <button>ログインする</button>
            </div>
        </form>
            <a href="/register">会員登録はこちら</a>
    </div>
</div>
@endsection