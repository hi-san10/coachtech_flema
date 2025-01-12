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
        @if(Auth::check())
        @foreach($my_nices as $my_nice)
        @if(is_null($my_nice->item->storage_image))
        <div class="item_all__item">
            <img src="{{ $my_nice->item->image }}" alt="" class="item__img">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $my_nice->item->id]) }}">{{ $my_nice->item->name }}</a>
            @if($my_nice->item->is_sold == 1)
            <p class="sold">sold</p>
            @endif
        </div>
        @else
        <div class="item_all__item">
            <img src="{{ asset($my_nice->item->storage_image) }}" alt="" class="item__img">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $my_nice->item->id]) }}">{{ $my_nice->item->name }}</a>
            @if($my_nice->item->is_sold == 1)
            <p class="sold">sold</p>
            @endif
        </div>
        @endif
        @endforeach
        @else
        @endif
    </div>
</div>
@endsection