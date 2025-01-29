@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="flema-item_detail__content">
    <div class="content-inner">
        <div class="inner__img">
            <img src="{{ $item->image }}" alt="">
        </div>
        <div class="inner__detail">
            <div class="detail__name-price">
                <h1>{{ $item->name }}</h1>
                @if(is_null($item->brand_name))
                <p>ブランド不明</p>
                @else
                <p>{{ $item->brand_name }}</p>
                @endif
                <p>¥{{ $item->price }}(税込)</p>
                @if(Auth::check())
                <a href="{{ route('nice', ['item_id' => $item->id]) }}">いいね</a>
                @else
                <p>いいね</p>
                @endif
                <span>{{ $nice }}</span>
                <p>コメント</p>
                <span>{{ $comment_count }}</span>
            </div>
            <a href="{{ route('purchase_top', ['item_id' => $item->id]) }}" class="purchase__link">購入手続きへ</a>
            <div class="explanation">
                <h2>商品説明</h2>
                <p>カラー : グレー</p>
                <p>新品<br>商品の状態は良好です。傷もありません。</p><br>
                <p>購入後、即発送致します。</p>
            </div>
            <div class="detail__info">
                <h2>商品の情報</h2>
                <p>カテゴリー</p>
                @foreach($categories as $category)
                <span>{{ $category->name }}</span>
                @endforeach
                <p>商品の状態<span>{{ $item->condition->condition }}</span></p>
            </div>
            <div class="detail__comment">
                <h2>コメント({{ $comment_count }})</h2>
                <div class="user-info">
                    @if($comment)
                    <img src="{{ asset($user->image) }}" alt="" class="user-info__img">
                    <p class="user-info__name">{{ $user->name }}</p>
                    <p class="user-info__comment">{{ $comment->comment }}</p>
                    @else
                    <img src="" alt="" class="user-info__img">
                    <p class="user-info__name"></p>
                    <p class="user-info__comment"></p>
                    @endif
                </div>
                @if(Auth::check())
                <form action="{{ route('comment', ['item_id' => $item->id]) }}" method="post" class="comment__form">
                    @csrf
                    <div class="form__inner">
                        <p>商品へのコメント</p>
                        @if(session('message'))
                        <p>{{ session('message') }}</p>
                        @endif
                        <textarea name="comment" id=""></textarea>
                        @error('comment')
                        <p>{{ $message }}</p>
                        @enderror
                        <button>コメントを送信する</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection