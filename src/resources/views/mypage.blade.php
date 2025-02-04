@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="flema-mypage">
    <div class="mypage-content">
        <div class="mypage-user">
            <div class="user__image">
                <img class="img" src="{{ asset($user->image) }}" alt="">
                <p class="name">{{ $user->name }}</p>
                <a class="setting__link" href="{{ route('setting', ['id' => Auth::id()]) }}">プロフィールを編集</a>
            </div>
            <div class="my-item__list">
                @if($prm == 'buy')
                <a class="list__link sell__link" href="{{ route('mypage') }}?page=sell">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy" style="color: red">購入した商品</a>
                @else
                <a class="list__link sell__link" href="{{ route('mypage') }}?page=sell" style="color: red">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy">購入した商品</a>
                @endif
                <p class="list__border"></p>
            </div>
            <div class="items">
                @foreach($items as $item)
                <div class="sell-item">
                    @if($item->image)
                    <img class="item__img" src="{{ $item->image }}" alt="">
                    @else
                    <img class="item__img" src="{{ asset($item->storage_image) }}" alt="">
                    @endif
                    <p class="item_name">{{ $item->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection