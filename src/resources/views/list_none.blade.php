@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_all.css') }}">
@endsection

@section('content')
<div class="flema-item_all">
    <div class="item_all-content">
        <div class="session__txt">
            @if(session('sell_message'))
            <p class="sell_message">{{ session('sell_message') }}</p>
            @endif
        </div>
        <div class="item_all__header">
            <a class="header-list__link" href="/">おすすめ</a>
            <a class="header-list__link" href="{{ route('mylist') }}" style="color: red">マイリスト</a>
            <p class="header__border"></p>
        </div>
    </div>
</div>
@endsection
