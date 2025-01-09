@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item_all.css') }}">
@endsection

@section('content')
<div class="flema-item_all">
    <div class="item_all-content">
        <div class="item_all__header">
        </div>
        @foreach($items as $item)
        @if(is_null($item->storage_image))
        <div class="item_all__item">
            <img src="{{ $item->image }}" alt="" class="item__img">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $item->id]) }}">{{ $item->name }}</a>
            @if($item->is_sold == 1)
            <p class="sold">sold</p>
            @endif
        </div>
        @else
        <div class="item_all__item">
            <img src="{{ asset($item->storage_image) }}" alt="" class="item__img">
            <a class="item_name" href="{{ route('item_detail', ['item_id' => $item->id]) }}">{{ $item->name }}</a>
            @if($item->is_sold == 1)
            <p class="sold">sold</p>
            @endif
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection