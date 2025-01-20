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
                <a href="">出品した商品</a>
                <a href="">購入した商品</a>
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