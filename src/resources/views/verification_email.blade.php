@extends('layouts/register_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verification_email.css') }}">
@endsection

@section('content')
<div class="flema-verification_email-content">
    <div class="content__txt">
        <p>登録していただいたメールアドレスに認証メールを送付しました。</p>
        <p>メール認証を完了してください。</p>
    </div>
    <div class="content__link">
        <a class="link__inner link-black" href="{{ route('certification', ['email' => $email, 'password' => $password]) }}">認証はこちらから</a>
    </div>
    <div class="content__link">
        <a class="link__inner link-blue" href="{{ route('resend', ['verification_email' => $email, 'password' => $password]) }}">認証メールを再送する</a>
    </div>
</div>
@endsection