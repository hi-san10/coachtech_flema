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
            <div class="my-item__list">
                @if($prm == 'buy')
                <a class="list__link" href="{{ route('mypage') }}?page=sell">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy" style="color: red">購入した商品</a>
                @else
                <a class="list__link" href="{{ route('mypage') }}?page=sell" style="color: red">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy">購入した商品</a>
                @endif
                <p class="header__border"></p>
            </div>
            @foreach($items as $item)
            <div class="sell-item">
                <img src="{{ $item->image }}" alt="">
                <img src="{{ asset($item->storage_image) }}" alt="">
                <p>{{ $item->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection