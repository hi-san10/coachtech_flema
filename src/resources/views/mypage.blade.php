@extends('layouts/app')

@section('css')
@endsection

@section('content')
<div class="flema-mypage">
    <div class="mypage-content">
        <div class="mypage-user">
            <div class="user__image">
                <img src="{{ asset($user->image) }}" alt="">
                <h1>{{ $user->name }}</h1>
                <a href="{{ route('setting', ['id' => Auth::id()]) }}">プロフィールを編集</a>
            </div>
        </div>
    </div>
</div>
@endsection