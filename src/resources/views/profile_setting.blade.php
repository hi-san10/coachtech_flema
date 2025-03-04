@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_setting.css') }}">
@endsection

@section('content')
<div class="flema-profile_setting">
    <!-- プロフィール初期設定済み -->
    @if($profile_id)
    <form class="setting__form" action="/mypage/image/update" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="profile_setting-content">
            <h1 class="profile__title">プロフィール設定</h1>
            <div class="content__image">
                <img class="profile__img" src="{{ asset($profile->image) }}">
                <label class="img__label" for="img">画像を選択する</label>
                <input type="file" name="image" id="img" onchange="imgChange()">
            </div>
            <div class="content__submit">
                <button class="content__btn">更新する</button>
                @error('image')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </form>
    <form class="setting__form" action="/mypage/update" method="post">
        @method('patch')
        @csrf
            <div class="content__item">
                <p class="item__txt">ユーザー名</p>
                <input class="item__input" type="text" name="user_name" placeholder="{{ $profile->name }}" value="{{ $profile->name }}">
                @error('user_name')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">郵便番号</p>
                <input class="item__input" type="text" name="post_code" placeholder="{{ $profile->post_code }}" value="{{ $profile->post_code }}">
                @error('post_code')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">住所</p>
                <input class="item__input" type="text" name="address" placeholder="{{ $profile->address }}" value="{{ $profile->address }}">
                @error('address')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">建物名</p>
                <input class="item__input" type="text" name="building_name" placeholder="{{ $profile->building_name }}" value="{{ $profile->building_name }}">
            </div>
            <div class="content__submit">
                <button class="content__btn">更新する</button>
            </div>
    </form>
    <!-- 初ログイン後プロフィール未設定 -->
    @else
    <form class="setting__form" action="/mypage/image/set_up" method="post" enctype="multipart/form-data">
        @csrf
        <div class="profile_setting-content">
            <h1 class="profile__title">プロフィール設定</h1>
            <div class="content__image">
                <img class="profile__img" alt="">
                <label class="img__label" for="img">画像を選択する</label>
                <input type="file" name="image" id="img" onchange="imgChange()">
                @error('image')
                <p class="error__message img-error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__submit">
                <button class="content__btn">更新する</button>
                @error('image')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </form>
        <div class="content__item">
            <p class="item__txt">ユーザー名</p>
            <input class="item__input" type="text" readonly>
        </div>
        <div class="content__item">
            <p class="item__txt">郵便番号</p>
            <input class="item__input"type="text" readonly>
        </div>
        <div class="content__item">
            <p class="item__txt">住所</p>
            <input class="item__input" type="text" readonly>
        </div>
        <div class="content__item">
            <p class="item__txt">建物名</p>
            <input class="item__input" type="text" readonly>
        </div>
    @endif
</div>
@endsection