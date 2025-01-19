@extends('layouts/app')

@section('css')
@endsection

@section('content')
<div class="flema-purchase">
    <div class="purchase-info">
        <div class="item-info">
            @if(is_null($item->image))
            <img src="{{ asset($item->storage_image) }}" alt="" class="item__img">
            @else
            <img src="{{ $item->image }}" alt="" class="item_img">
            @endif
            <div class="item-main_info">
                <p>{{ $item->name }}</p>
                <p>¥{{ number_format($item->price) }}</p>
            </div>
        </div>
        <div class="payment_method">
            <p>支払い方法</p>
            <select name="payment_method" id="method" onchange="priceChange()">
                <option value="">選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="カード払い">カード払い</option>
            </select>
        </div>
        <div class="user-address">
            <p>配送先</p>
            <a href="{{ route('address_change_top', ['item_id' => $item->id]) }}">変更する</a>
            <p>〒{{ $user->post_code }}</p>
            <p>{{ $user->address }}<br>
            {{ $user->building_name }}</p>
        </div>
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
    </div>
</div>
@endsection