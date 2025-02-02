@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_setting.css') }}">
@endsection

@section('content')
<div class="flema-profile_setting">
    <!-- プロフィール初期設定済み -->
    @if($profile_id)
    <form class="setting__form" action="/mypage/update" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="profile_setting-content">
            <h1 class="profile__title">プロフィール設定</h1>
            <div class="content__image">
                <img class="profile__img" src="{{ asset($profile->image) }}" alt="" value="{{ asset($profile->image) }}">
                <label class="img-label" for="img">画像を選択する</label>
                <input type="file" name="image" id="img-label">
            </div>
            <div class="content__item">
                <p class="item__txt">ユーザー名</p>
                <input class="item__input" type="text" name="user_name" placeholder="{{ $profile->name }}" value="{{ $profile->name }}">
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
            </div>
            <div class="content__item">
                <p class="item__txt">建物名</p>
                <input class="item__input" type="text" name="building_name" placeholder="{{ $profile->building_name }}" value="{{ $profile->building_name }}">
            </div>
            <div class="content__submit">
                <button class="content__btn">更新する</button>
            </div>
        </div>
    </form>
    <!-- 初ログイン後プロフィール未設定 -->
    @else
    <form class="setting__form" action="/mypage/set_up" method="post" enctype="multipart/form-data">
        @csrf
        <div class="profile_setting-content">
            <h1 class="profile__title">プロフィール設定</h1>
            <div class="content__image">
                <img class="profile__img" alt="">
                <label class="img-label" for="img">画像を選択する</label>
                <input type="file" name="image" id="img">
                @error('image')
                <p class="error__message img-error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">ユーザー名</p>
                <input class="item__input" type="text" name="user_name">
                @error('user_name')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">郵便番号</p>
                <input class="item__input"type="text" name="post_code">
                @error('post_code')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">住所</p>
                <input class="item__input" type="text" name="address">
                @error('address')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p class="item__txt">建物名</p>
                <input class="item__input" type="text" name="building_name">
            </div>
            <div class="content__submit">
                <button class="content__btn">更新する</button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection