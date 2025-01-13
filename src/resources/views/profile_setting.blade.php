@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_setting.css') }}">
@endsection

@section('content')
<div class="flema-profile_setting">
    <!-- プロフィール初期設定済み -->
    @if($profile_id)
    <form action="/mypage/update" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="profile_setting-content">
            <h1>プロフィール設定</h1>
            <div class="content__image">
                <img src="{{ asset($profile->image) }}" alt="" value="{{ asset($profile->image) }}">
                <input type="file" name="image">
            </div>
            <div class="content__item">
                <p>ユーザー名</p>
                <input type="text" name="user_name" placeholder="{{ $profile->name }}" value="{{ $profile->name }}">
            </div>
            <div class="content__item">
                <p>郵便番号</p>
                <input type="text" name="post_code" placeholder="{{ $profile->post_code }}" value="{{ $profile->post_code }}">
                @error('post_code')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p>住所</p>
                <input type="text" name="address" placeholder="{{ $profile->address }}" value="{{ $profile->address }}">
            </div>
            <div class="content__item">
                <p>建物名</p>
                <input type="text" name="building_name" placeholder="{{ $profile->building_name }}" value="{{ $profile->building_name }}">
            </div>
            <div class="content__submit">
                <button>更新する</button>
            </div>
        </div>
    </form>
    <!-- 初ログイン後プロフィール未設定 -->
    @else
    <form action="/mypage/set_up" method="post" enctype="multipart/form-data">
        @csrf
        <div class="profile_setting-content">
            <h1>プロフィール設定</h1>
            <div class="content__image">
                <input type="file" name="image">
                @error('image')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p>ユーザー名</p>
                <input type="text" name="user_name">
                @error('user_name')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p>郵便番号</p>
                <input type="text" name="post_code">
                @error('post_code')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p>住所</p>
                <input type="text" name="address">
                @error('address')
                <p class="error__message">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__item">
                <p>建物名</p>
                <input type="text" name="building_name">
            </div>
            <div class="content__submit">
                <button>更新する</button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection