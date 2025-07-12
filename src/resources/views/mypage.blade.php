@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="flema-mypage">
    <div class="mypage-content">
        <div class="mypage-user">
            <div class="user__image">
                <img class="img" src="{{ asset($user->image) }}" alt="">
                <p class="name">{{ $user->name }}</p>
                <a class="setting__link" href="{{ route('setting', ['id' => Auth::id()]) }}">プロフィールを編集</a>
            </div>
            <div class="my-item__list">
                @if($prm == 'buy')
                <a class="list__link sell__link" href="{{ route('mypage') }}?page=sell">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy" style="color: red">購入した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=transaction">取引中の商品<span>{{ $total_message }}</span></a>
                @elseif ($prm == 'transaction')
                <a class="list__link sell__link" href="{{ route('mypage') }}?page=sell">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy">購入した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=transaction" style="color: red">取引中の商品<span class="transaction_count">{{ $total_message }}</span></a>
                @else
                <a class="list__link sell__link" href="{{ route('mypage') }}?page=sell" style="color: red">出品した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=buy">購入した商品</a>
                <a class="list__link" href="{{ route('mypage') }}?page=transaction">取引中の商品<span>{{ $total_message }}</span></a>
                @endif
                <p class="list__border"></p>
            </div>
            <!-- 取引中の商品 -->
            <div class="items">
                @if ($prm == 'transaction')
                @foreach($items as $item)
                <div class="sell-item">
                    @if($item->image)
                    <a class="item_name" href="{{ route('transaction_top', ['item_id' => $item->item_id, 'shipping_id' => $item->shipping_address_id]) }}">
                        <img class="item__img" src="{{ asset($item->image) }}" alt="">
                    </a>
                    @else
                    <a class="item_name" href="{{ route('transaction_top', ['item_id' => $item->item_id, 'shipping_id' => $item->shipping_address_id]) }}">
                        <img class="item__img" src="{{ asset($item->storage_image) }}" alt="">
                    </a>
                    @endif
                    <p class="item_name">{{ $item->name }}</p>
<!-- メッセージカウント数のcss -->
                    <p>{{ $item->other_user_message_count }}</p>
                </div>
                @endforeach
                @else
                <!-- 出品、購入した商品 -->
                @foreach($items as $item)
                <div class="sell-item">
                    @if($item->image)
                    <img class="item__img" src="{{ $item->image }}" alt="">
                    @else
                    <img class="item__img" src="{{ asset($item->storage_image) }}" alt="">
                    @endif
                    <p class="item_name">{{ $item->name }}</p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection