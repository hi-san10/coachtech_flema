@extends('layouts/register_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div>
    <div>
        <p>会員登録ありがとうございます<br>
        以下をクリックして認証は完了です</p>
    </div>
    <div>
        <a href="{{ route('verify', ['email' => $email]) }}">ユーザー認証完了</a>
    </div>
</div>
@endsection