@extends('layouts/app')

@section('css')
@endsection

@section('content')
<div class="flema-sell">
    <div class="sell-content">
        <form action="{{ route('sell') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="sell-title">
                <h1>商品の出品</h1>
            </div>
            <div class="sell-image">
                <p>商品画像</p>
                <input type="file" name="image">
            </div>
            <div class="sell-text">
                <h2>商品の詳細</h2>
            </div>
            <div class="sell-category">
                <p>カテゴリー</p>
                @foreach($categories as $category)
                <input type="checkbox" name="categories[]" value="{{ $category->id }}">{{ $category->name }}
                @endforeach
            </div>
            <div class="sell-condition">
                <p>商品のの状態</p>
                <select name="condition_id" id="">
                    <option value="">選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sell-text">
                <h2>商品名と説明</h2>
            </div>
            <div class="sell-detail">
                <p>商品名</p>
                <input type="text" name="item_name">
                <p>商品の説明</p>
                <textarea name="detail" id=""></textarea>
                <p>商品のブランド</p>
                <input type="text" name="brand_name">
                <p>販売価格</p>
                <input type="text" name="price">
            </div>
            <div class="sell-btn">
                <button>出品する</button>
            </div>
        </form>
    </div>
</div>
@endsection