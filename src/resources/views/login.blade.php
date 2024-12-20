@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="flema-login">
    <div class="login-content">
        <h1>ログイン</h1>
        <div class="login-form">
            <div class="form__inner">
                <p></p>
            </div>
            <div class="login-form">

            </div>
            <div class="login-form"></div>
            <a href="/register">会員登録はこちら</a>
        </div>
    </div>
</div>
@endsection