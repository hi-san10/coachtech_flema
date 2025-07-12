@extends('layouts.register_header')

@section('css')
@endsection

@section('content')
<div class="transaction_top-container">
    <!-- その他の取引 -->
    <div class="sidebar">
        <p class="sidebar-title">その他の取引</p>
        @foreach ($transaction_items as $transaction_item)
        <a href="{{ route('transaction_top', ['item_id' => $transaction_item->item_id, 'shipping_id' => $transaction_item->shipping_address_id]) }}" class="transaction__link">{{ $transaction_item->name }}</a>
        @endforeach
    </div>
    <!-- 当取引 -->
    <div class="main-content">
        <div class="content-title">
            @if ($item->user_id == Auth::id())
            <img src="{{ $shipping_address->profile->image }}" alt="" class="user__image">
            <h1 class="user__name">{{ $shipping_address->profile->name }}さんとの取引画面</h1>
            @else
            <img src="{{ $item->user->profile->image }}" alt="" class="user__image">
            <h1 class="user__name">{{ $item->user->profile->name }}さんとの取引画面</h1>
            <a href="#evaluation">取引を完了する</a>
            <div class="evaluation" id="evaluation">
                <p>取引が完了しました。</p>
                <small>今回の取引相手はどうでしたか？</small>
                <form action="{{ route('evaluation', ['transaction_id' => $transaction->id]) }}" method="post">
                    @csrf
                    <input type="radio" name="point" class="point-star__input" id="star1" value="1">
                    <label for="star1" class="point-star__label">☆</label>
                    <input type="radio" name="point" class="point-star__input" id="star2" value="2">
                    <label for="star2" class="point-star__label">☆</label>
                    <input type="radio" name="point" class="point-star__input" id="star3" value="3">
                    <label for="star3" class="point-star__label">☆</label>
                    <input type="radio" name="point" class="point-star__input" id="star4" value="4">
                    <label for="star4" class="point-star__label">☆</label>
                    <input type="radio" name="point" class="point-star__input" id="star5" value="5">
                    <label for="star5" class="point-star__label">☆</label>
                    <input type="submit" class="submit">
                </form>

            </div>
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
        <!-- 取引メッセージ -->
        <div class="transaction-message">
            @if (isset($transaction_messages))
            @foreach ($transaction_messages as $transaction_message)
            <div class="message-user">
                <img src="{{ $transaction_message->user->profile->image }}" alt="" class="message-user__img">
                <p class="message-user__name">{{ $transaction_message->user->profile->name }}</p>
            </div>
            <div class="message-content">
                <p class="message-content__inner">{{ $transaction_message->message }}</p>
            </div>
            @endforeach
            @if ($last_message)
            <div class="last_message">
                @if ($last_message->user_id != Auth::id())
                <div class="message-user">
                    <img src="{{ $last_message->user->profile->image }}" alt="" class="message-user__img">
                    <p class="message-user__name">{{ $last_message->user->profile->name }}</p>
                </div>
                @else
                <form action="{{ route('update_message', ['message_id' => $last_message->id]) }}" method="post">
                    @method('patch')
                    @csrf
                    <input type="text" name="update_message" placeholder="{{ $last_message->message }}">
                    <input type="submit" value="編集">
                </form>
                <a href="{{ route('delete_message', ['message_id' => $last_message->id]) }}">削除</a>
                @endif
            </div>
            @endif
            @endif
        </div>
        <!-- メッセージ送信欄 -->
        <div class="message-send_bar">
            <form action="{{ route('post', ['item_id' => $item->id]) }}" class="message__form" method="post">
                @csrf
                @error('message')
                <p class="error__msg">{{ $message }}</p>
                @enderror
                <input id="chat_input" name="message" class="message">
                @error('image')
                <p class="error__msg">{{ $message }}</p>
                @enderror
                <input type="file" name="image" class="img">
                <input type="submit">
            </form>
        </div>
    </div>
</div>
@endsection