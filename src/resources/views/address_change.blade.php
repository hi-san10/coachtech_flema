@extends('layouts/app')

@section('css')
@endsection

@section('content')
<div class="flema-address_change">
    <div class="address_change-content">
        <h1>住所の変更</h1>
        <form action="{{ route('address_change', ['item_id' => $item->id]) }}" method="post" class="address_change__form">
            @method('patch')
            @csrf
            <div class="content-inner">
                <p>郵便番号</p>
                <input type="text" name="post_code" value="{{ $user->post_code }}">
                @error('post_code')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="content-inner">
                <p>住所</p>
                <input type="text" name="address" value="{{ $user->address }}">
                @error('address')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="content-inner">
                <p>建物名</p>
                @if(is_null($user->building_name))
                <input type="text">
                @else
                <input type="text" name="building_name" value="{{ $user->building_name }}">
                @endif
            </div>
            <button>更新する</button>
        </form>
    </div>
</div>
@endsection