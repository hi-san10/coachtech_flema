@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="flema-item_detail__content">
    @if(session('message'))
    <p class="session_message">{{ session('message') }}</p>
    @endif
    <div class="content-inner">
        <div class="inner__img">
            @if($item->image)
            <img class="item__img" src="{{ $item->image }}" alt="">
            @else
            <img class="item__img" src="{{ asset($item->storage_image) }}" alt="">
            @endif
        </div>
        <div class="inner__detail">
            <div class="detail__name-price">
                <h1 class="item_name">{{ $item->name }}</h1>
                @if(is_null($item->brand_name))
                <small class="brand_name">ブランド不明</small>
                @else
                <small class="brand_name">{{ $item->brand_name }}</small>
                @endif
                <span>¥</span><p class="item_price">{{ number_format($item->price) }}</p><span>(税込)</span>
                <div class="icon">
                    <div class="icon__inner">
                        @if(!Auth::check())
                        <a class="nice_icon" href="">☆</a>
                        @elseif($nice)
                        <a class="nice_icon red_icon" href="{{ route('nice', ['item_id' => $item->id]) }}">★</a>
                        @else
                        <a class="nice_icon" href="{{ route('nice', ['item_id' => $item->id]) }}">☆</a>
                        @endif
                        <span class="count">{{ $nice_count }}</span>
                    </div>
                    <div>
                        <span class="comment_icon">💬</span>
                        <span class="count">{{ $comment_count }}</span>
                    </div>
                </div>
            </div>
            @if(is_null($item->shipping_address_id))
            <a href="{{ route('purchase_top', ['item' => $item->id]) }}" class="purchase__link">購入手続きへ</a>
            @else
            @endif
            <div class="explanation">
                <h2>商品説明</h2>
                <p>カラー : グレー</p>
                <p>新品<br>商品の状態は良好です。傷もありません。</p>
                <p>購入後、即発送致します。</p>
            </div>
            <div class="detail__info">
                <h2>商品の情報</h2>
                <div class="detail_category">
                    <p class="category_title">カテゴリー</p>
                    <div class="categories">
                        @foreach($categories as $category)
                        <span class="category_name">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <p class="detail">商品の状態</p><span>{{ $item->condition->condition }}</span>
            </div>
            <div class="detail__comment">
                <h2>コメント({{ $comment_count }})</h2>
                <div class="user-info">
                    @if($comments)
                    @foreach($comments as $comment)
                    <div class="comment_user">
                        <img src="{{ asset($comment->image) }}" alt="" class="user-info__img">
                        <span class="user-info__name">{{ $comment->name }}</span>
                    </div>
                    <p class="user-info__comment">{{ $comment->comment }}</p>
                    @endforeach
                    @else
                    <div class="comment_user">
                        <img class="user-info__img">
                        <span class="user-info__name"></span>
                    </div>
                    <p class="user-info__comment"></p>
                    @endif
                </div>
                @if(Auth::check())
                <form action="{{ route('comment', ['item_id' => $item->id]) }}" method="post" class="comment__form">
                    @csrf
                    <div class="form__inner">
                        <p class="item__comment">商品へのコメント</p>
                        <textarea name="comment" rows="10"></textarea>
                        @error('comment')
                        <p class="error_message">{{ $message }}</p>
                        @enderror
                        <button class="comment__link">コメントを送信する</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
