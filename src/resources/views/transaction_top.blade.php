@extends('layouts.register_header')

@section('css')
@endsection

@section('content')
<div class="transaction_top-container">
    <div class="sidebar">
        <p class="sidebar-title">その他の取引</p>
        @foreach ($transaction_items as $transaction_item)
        <a href="{{ route('transaction_top', ['item_id' => $transaction_item->item_id, 'shipping_id' => $transaction_item->shipping_address_id]) }}" class="transaction__link">{{ $transaction_item->name }}</a>
        @endforeach
    </div>
    <div class="main-content">
        <div class="content-title">
            @if ($item->user_id == Auth::id())
            <img src="{{ $shipping_address->profile->image }}" alt="" class="user__image">
            <h1 class="user__name">{{ $shipping_address->profile->name }}さんとの取引画面</h1>
            @else
            <img src="{{ $item->user->profile->image }}" alt="" class="user__image">
            <h1 class="user__name">{{ $item->user->profile->name }}さんとの取引画面</h1>
            <a href="">取引を完了する</a>
            @endif
        </div>
        <div class="item-info">
            <div class="item-info__box">
                @if ($item->image)
                <img src="{{ $item->image }}" alt="" class="item__image">
                @else
                <img src="{{ $item->storage_image }}" alt="" class="item__image">
                @endif
            </div>
            <div class="item-info__box">
                <h2 class="item-name">{{ $item->name }}</h2>
                <p class="item-price">{{ $item->price }}</p>
            </div>
        </div>
        <div class="transaction-message">
            @foreach ($transaction_messages as $transaction_message)
            <div class="message-user">
                <img src="{{ $transaction_message->user->profile->image }}" alt="" class="message-user__img">
                <p class="message-user__name">{{ $transaction_message->user->profile->name }}</p>
            </div>
            <div class="message-content">
                <p class="message-content__inner">{{ $transaction_message->message }}</p>
            </div>
            @endforeach
        </div>
        <div class="message-send_bar">
            <form action="" class="message__form">
                <input type="text" class="message" placeholder="取引メッセージを入力してください">
                <input type="file" class="img">
                <input type="submit">
            </form>
        </div>
    </div>
</div>
@endsection