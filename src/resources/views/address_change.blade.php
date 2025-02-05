@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address_change.css') }}">
@endsection

@section('content')
<div class="flema-address_change">
    <div class="address_change-content">
        <h1>住所の変更</h1>
        <form action="{{ route('change_shipping_address', ['item_id' => $item->id]) }}" method="post" class="address_change__form">
            @csrf
            <div class="content-inner">
                <p class="inner__txt">郵便番号</p>
                <input class="inner__input" type="text" name="post_code" value="{{ $user->post_code }}">
                @error('post_code')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="content-inner">
                <p class="inner__txt">住所</p>
                <input class="inner__input" type="text" name="address" value="{{ $user->address }}">
                @error('address')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="content-inner">
                <p class="inner__txt">建物名</p>
                @if(is_null($user->building_name))
                <input class="inner__input" type="text" name="building_name">
                @else
                <input class="inner__input" type="text" name="building_name" value="{{ $user->building_name }}">
                @endif
            </div>
            <button class="form__btn">更新する</button>
        </form>
    </div>
</div>
@endsection