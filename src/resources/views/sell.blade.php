@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="flema-sell">
    <div class="sell-content">
        <form action="{{ route('sell') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <h1 class="sell-title">商品の出品</h1>
            </div>
            <div class="sell-image">
                <p>商品画像</p>
                <label class="img__label" for="img"><span class="label__txt">画像を選択する</span></label>
                <input type="file" name="image" id="img" onchange="itemChange()">
                @error('image')
                <p class="error_message">{{ $message }}</p>
                @enderror
            </div>
            <div class="detail__txt">
                <h2 class="detail__txt-content">商品の詳細</h2>
            </div>
            <p class="border"></p>
            <div class="sell-category">
                <p>カテゴリー</p>
                <div class="category_item">
                    @foreach($categories as $category)
                    <label><input type="checkbox" name="categories[]" value="{{ $category->id }}"><span class="category_name">{{ $category->name }}</span></label>
                    @endforeach
                </div>
                @error('categories')
                <p class="error_message">{{ $message }}</p>
                @enderror
            </div>
            <div class="sell-condition">
                <p>商品の状態</p>
                <select class="sell__input" name="condition_id">
                    <option value="">選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
                @error('condition_id')
                <p class="error_message">{{ $message }}</p>
                @enderror
            </div>
            <div class="detail__txt">
                <h2 class="detail__txt-content">商品名と説明</h2>
            </div>
            <p class="border"></p>
            <div class="sell-detail">
                <p class="sell__txt">商品名</p>
                <input class="sell__input" type="text" name="item_name">
                @error('item_name')
                <p class="error_message">{{ $message }}</p>
                @enderror
                <p class="sell__txt">商品の説明</p>
                <textarea class="sell__input" name="detail" rows="8"></textarea>
                @error('detail')
                <p class="error_message">{{ $message }}</p>
                @enderror
                <p class="sell__txt">商品のブランド</p>
                <input class="sell__input" type="text" name="brand_name">
                <p class="sell__txt">販売価格</p>
                <input class="sell__input" type="text" name="price" placeholder="¥">
                @error('price')
                <p class="error_message">{{ $message }}</p>
                @enderror
            </div>
            <button class="sell__btn">出品する</button>
        </form>
    </div>
</div>
@endsection