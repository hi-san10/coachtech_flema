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
            <a class="header-list__link" href="/" @if(!$prm) style="color: red" @endif>おすすめ</a>
            <a class="header-list__link" href="{{ route('index', ['page' => 'mylist', 'search_word' => $word]) }}" @if($prm) style="color: red" @endif>マイリスト</a>
            <p class="header__border"></p>
        </div>
        <!-- 未ログインのマイリスト非表示 -->
        @if(!Auth::check() && $prm == 'mylist')

        <!-- ログインユーザーのマイリスト表示 -->
        @else
        @foreach($items as $item)
        @if(is_null($item->storage_image))
        <div class="item_all__item">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $item->id]) }}">
                <img src="{{ $item->image }}" alt="" class="item__img">{{ $item->name }}
            </a>
            @if(!$item->shipping_address_id == null)
            <p class="sold">sold</p>
            @endif
        </div>
        @else
        <div class="item_all__item">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $item->id]) }}">
                @if(config('app.env') == 'local')
                <img src="{{ asset($item->storage_image) }}" alt="" class="item__img">{{ $item->name }}
                @else
                <img  src="{{ Storage::disk('s3')->url($item->storage_image) }}" alt="" class="item__img">{{ $item->name }}
                @endif
            </a>
            @if(!$item->shipping_address_id == null)
            <p class="sold">sold</p>
            @endif
        </div>
        @endif
        @endforeach
        @endif
    </div>
</div>
@endsection