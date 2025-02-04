@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="flema-purchase">
    <div class="purchase-info">
        <div class="item-info">
            @if(is_null($item->image))
            <img class="item__img" src="{{ asset($item->storage_image) }}" alt="" class="item__img">
            @else
            <img class="item__img" src="{{ $item->image }}" alt="" class="item_img">
            @endif
            <div class="item-main_info">
                <p class="item__name">{{ $item->name }}</p>
                <p class="item__price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>
        <p class="border"></p>
        <div class="payment_method">
            <p class="purchase__txt">支払い方法</p>
            <select class="payment__select" name="payment_method" id="method" onchange="priceChange()">
                <option value="">選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="カード払い">カード払い</option>
            </select>
        </div>
        <p class="border"></p>
        <div class="user-address">
            <p class="purchase__txt shipping__txt">配送先</p>
            <a class="change__link" href="{{ route('address_change_top', ['item_id' => $item->id]) }}">変更する</a>
            <p class="post_code">〒{{ $user->post_code }}</p>
            <p class="address">{{ $user->address }}<br>
            {{ $user->building_name }}</p>
        </div>
        <p class="border"></p>
    </div>
    <div class="purchase-decide">
        <table>
            <tr>
                <th>商品代金</th>
                <td>{{ number_format($item->price) }}</td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td id="payment_method"></td>
            </tr>
        </table>
        <div class="content">
            <form action="{{ asset('charge') }}" method="POST">
                {{ csrf_field() }}
                        <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="{{ $item->price }}"
                                data-name="Stripe Demo"
                                data-label="決済をする"
                                data-description="Online course about integrating Stripe"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-currency="JPY">
                        </script>
            </form>
        </div>
    </div>
</div>
@endsection