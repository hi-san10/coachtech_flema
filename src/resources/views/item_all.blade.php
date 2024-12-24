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
        <div class="item_all__item">
            <img src="{{ $item->image }}" alt="" class="item__img">
            <a href="{{ route('item_detail', ['item_id' => $item->id]) }}">{{ $item->name }}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection