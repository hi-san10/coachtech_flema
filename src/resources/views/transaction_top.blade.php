@extends('layouts.register_header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/transaction_top.css') }}">
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
            <a href="#evaluation" class="evaluation__link">取引を完了する</a>
            @endif
        </div>
        <p class="border"></p>
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
        <p class="border"></p>
        <!-- 取引メッセージ -->
        <div class="transaction-message">
            @if (isset($transaction_messages))
            @foreach ($transaction_messages as $transaction_message)
            <div class="message-user">
                <div class="{{ $transaction_message->user_id == Auth::id() ? 'message-user__item' : 'message-other-user__item' }}">
                    <img src="{{ $transaction_message->user->profile->image }}" alt="" class="message-user__img">
                    <p class="message-user__name">{{ $transaction_message->user->profile->name }}</p>
                </div>
                <div class="message-content">
                    <p class="{{ $transaction_message->user_id == Auth::id() ? 'message-content__inner' : 'message-content__inner--other' }}">{{ $transaction_message->message }}</p>
                </div>
            </div>
            @if (!is_null($transaction_message->image))
            <img src="{{ asset($transaction_message->image) }}" class="{{ $transaction_message->user_id == Auth::id() ? 'transaction-item__img' : 'transaction-item__img--other' }}" alt="">
            @endif
            @endforeach
            @if ($last_message)
            <div class="last_message">
                @if ($last_message->user_id != Auth::id())
                <div class="message-user">
                    <div class="{{ $last_message->user_id == Auth::id() ? 'message-user__item' : 'message-other-user__item' }}">
                        <img src="{{ $last_message->user->profile->image }}" alt="" class="message-user__img">
                        <p class="message-user__name">{{ $last_message->user->profile->name }}</p>
                    </div>
                    <p class="other-user__message">{{ $last_message->message }}</p>
                </div>
                @if (!is_null($last_message->image))
                <img src="{{ asset($last_message->image) }}" class="transaction-item__img--other" alt="">
                @endif
                @else
                <form action="{{ route('update_message', ['message_id' => $last_message->id]) }}" method="post" id="update__form">
                    @method('patch')
                    @csrf
                    <div class="message-user message-myself">
                        <div class="message-user__item message-user__item-myself">
                            <img src="{{ $last_message->user->profile->image }}" alt="" class="message-user__img">
                            <p class="message-user__name">{{ $last_message->user->profile->name }}</p>
                        </div>
                        <textarea rows="1" cols="130" type="text" name="update_message" class="update_message" value="{{ $last_message->message }}">{{ $last_message->message }}</textarea>
                        @if ($last_message->message == '商品を購入しました')
                        @else
                        <div class="message-inner">
                            <button class="message-inner__btn" for="update__form">編集</button>
                            <a href="{{ route('delete_message', ['message_id' => $last_message->id]) }}" class="message-inner__btn">削除</a>
                        </div>
                        @endif
                    </div>
                    @if (!is_null($last_message->image))
                    <img src="{{ asset($last_message->image) }}" class="transaction-item__img" alt="">
                    @endif
                </form>
                @endif
            </div>
            @endif
            @endif
        </div>
        <!-- メッセージ送信欄 -->
        <div class="message-send_bar">
            <form action="{{ route('post', ['item_id' => $item->id]) }}" class="message__form" method="post" enctype="multipart/form-data">
                @csrf
                <table>
                    <tr>
                        <td class="td-error__msg">
                            @error('message')
                            <p class="error__msg">{{ $message }}</p>
                            @enderror
                        </td>
                        <td>
                            @error('image')
                            <p class="error__msg">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="td-textarea">
                            <textarea rows="1" cols="130" name="message" class="message" placeholder="取引メッセージを記入してください"></textarea>
                        </td>
                        <td class="td-img__label">
                            <label for="img" class="img__label">画像を追加</label>
                            <input type="file" name="image" id="img">
                        </td>
                        <td>
                            <label for="submit" class="message__submit-label"><i class="fa-solid fa-paper-plane"></i></label>
                            <input type="submit" id="submit" class="message__submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- 評価画面 -->
    <div class="{{ $transaction->buyer_completion == false ? 'evaluation' : 'seller-evaluation' }}" id="evaluation">
        <div class="{{ $transaction->buyer_completion == false ? 'evaluation-content' : 'seller-evaluation-content' }}">
            <p class="content-message">取引が完了しました。</p>
            <p class="border"></p>
            <span class="content-message--small">今回の取引相手はどうでしたか？</span>
            <form action="{{ route('evaluation', ['transaction_id' => $transaction->id]) }}" method="post" id="evaluation__form" class="evaluation__form">
                @csrf
                <input type="radio" name="point" class="point-star__input" id="star5" value="5">
                <label for="star5" class="point-star__label">★</label>
                <input type="radio" name="point" class="point-star__input" id="star4" value="4">
                <label for="star4" class="point-star__label">★</label>
                <input type="radio" name="point" class="point-star__input" id="star3" value="3">
                <label for="star3" class="point-star__label">★</label>
                <input type="radio" name="point" class="point-star__input" id="star2" value="2">
                <label for="star2" class="point-star__label">★</label>
                <input type="radio" name="point" class="point-star__input" id="star1" value="1">
                <label for="star1" class="point-star__label">★</label>
            </form>
            <p class="border"></p>
            <input type="submit" class="submit" form="evaluation__form" value="送信する">
        </div>
    </div>
</div>

@endsection