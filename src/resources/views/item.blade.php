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
                <p>ブランド名</p>
                <p>¥{{ $item->price }}(税込)</p>
            </div>
            <div class="explanation">
                <h2>商品説明</h2>
                <p>カラー : グレー</p>
                <p>新品<br>商品の状態は良好です。傷もありません。</p><br>
                <p>購入後、即発送致します。</p>
            </div>
            <div class="detail__info">
                <h2>商品の情報</h2>
                <p>カテゴリー</p>
                <p>商品の状態<span>{{ $item->condition }}</span></p>
            </div>
            <div class="detail__comment">
                <h2>コメント()</h2>
            </div>
        </div>
    </div>
</div>
@endsection