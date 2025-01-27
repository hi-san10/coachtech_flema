<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flema</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <div class="flema">
        <header class="header">
            <div class="header_logo">
                <svg width="300" height="32" viewBox="0 0 300 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_161_1026)">
                <rect width="300" height="32" fill="black"/>
                <path d="M80.36 22.2665C79.2898 27.8932 75.4303 31.9998 68.5546 31.9998C59.8465 31.9998 55.752 25.2354 55.752 16.6843C55.752 8.13317 60.0087 1.05762 68.8303 1.05762C76.1438 1.05762 79.679 5.72428 80.36 10.791H74.4411C73.8411 8.4354 72.3736 6.12428 68.6357 6.12428C63.7465 6.12428 61.8817 10.9687 61.8817 16.471C61.8817 21.5376 63.5114 26.8976 68.7979 26.8976C72.6898 26.8976 73.8817 24.0621 74.4006 22.2754H80.36V22.2665Z" fill="white"/>
                <path d="M110.643 16.4176C110.643 24.7998 106.07 31.9998 97.1678 31.9998C88.265 31.9998 84.0488 25.1465 84.0488 16.5065C84.0488 7.8665 89.0191 1.05762 97.5245 1.05762C105.552 1.05762 110.643 7.20873 110.643 16.4176ZM90.1705 16.3732C90.1705 22.2665 92.5137 26.7198 97.3624 26.7198C102.649 26.7198 104.514 21.8754 104.514 16.5065C104.514 10.7909 102.365 6.33762 97.2813 6.33762C92.1975 6.33762 90.1624 10.5243 90.1624 16.3732H90.1705Z" fill="white"/>
                <path d="M166.411 22.2665C165.341 27.8932 161.481 31.9998 154.605 31.9998C145.897 31.9998 141.803 25.2354 141.803 16.6843C141.803 8.13317 146.059 1.05762 154.881 1.05762C162.195 1.05762 165.73 5.72428 166.411 10.791H160.492C159.892 8.4354 158.424 6.12428 154.687 6.12428C149.797 6.12428 147.932 10.9687 147.932 16.471C147.932 21.5376 149.562 26.8976 154.849 26.8976C158.741 26.8976 159.932 24.0621 160.451 22.2754H166.411V22.2665Z" fill="white"/>
                <path d="M171.455 1.49316H177.374V13.1909H188.425V1.49316H194.344V31.5643H188.425V18.5598H177.374V31.5643H171.455V1.49316Z" fill="white"/>
                <path d="M206.351 6.81761H198.008V1.49316H220.589V6.81761H212.278V31.5643H206.359V6.81761H206.351Z" fill="white"/>
                <path d="M243.122 18.6043H230.003V26.2398H244.468L243.755 31.5643H224.238V1.49316H243.673V6.81761H230.003V13.2354H243.122V18.6043Z" fill="white"/>
                <path d="M272.059 22.2665C270.989 27.8932 267.13 31.9998 260.254 31.9998C251.546 31.9998 247.451 25.2354 247.451 16.6843C247.451 8.13317 251.708 1.05762 260.53 1.05762C267.843 1.05762 271.378 5.72428 272.059 10.791H266.14C265.54 8.4354 264.073 6.12428 260.335 6.12428C255.446 6.12428 253.581 10.9687 253.581 16.471C253.581 21.5376 255.211 26.8976 260.497 26.8976C264.389 26.8976 265.581 24.0621 266.1 22.2754H272.059V22.2665Z" fill="white"/>
                <path d="M277.104 1.49316H283.022V13.1909H294.074V1.49316H299.993V31.5643H294.074V18.5598H283.022V31.5643H277.104V1.49316Z" fill="white"/>
                <path d="M129.721 1.49316H122.286L112.986 31.5643H118.832C120.381 26.1065 125.116 9.12872 125.789 6.15983H125.83C126.503 8.86205 131.278 25.1909 133.224 31.5643H139.467L129.721 1.49316Z" fill="white"/>
                <path d="M45.9659 0H18.0496C9.99829 0 2.06856 7.16444 0.341531 16C-1.3936 24.8356 3.73072 32 11.774 32H20.6037C21.7956 32 22.9713 30.9422 23.2307 29.6267L24.4632 23.3511C24.7226 22.0444 23.9604 20.9778 22.7686 20.9778H12.9496C10.7118 20.9778 9.13072 19.0844 9.54423 16.6311C9.97396 14.0889 12.2361 12.0089 14.5388 12.0089H29.9767C31.1686 12.0089 31.9307 13.0667 31.6713 14.3822L28.6794 29.6356C28.4199 30.9422 29.1821 32.0089 30.374 32.0089H37.5334C38.7253 32.0089 39.901 30.9511 40.1604 29.6356L43.1523 14.3822C43.4118 13.0756 44.5875 12.0089 45.7794 12.0089C46.9713 12.0089 48.1469 10.9511 48.4064 9.63556L50.2956 0H45.974L45.9659 0Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_161_1026">
                <rect width="300" height="32" fill="white"/>
                </clipPath>
                </defs>
                </svg>
            </div>
            <div class="search">
                <form class="search__form" action="{{ route('index') }}?page=mylist">
                    <input class="search__form-word" type="text" name="search_word" placeholder="     なにをお探しですか？">
                </form>
            </div>
            <div class="header__nav">
                @if(Auth::check())
                <form action="/logout" method="post">
                    @csrf
                    <button class="nav__btn logout__btn">ログアウト</button>
                </form>
                <a class="nav__btn" href="{{ route('mypage', ['id' => Auth::id()]) }}">マイページ</a>
                @else
                <a class="nav__btn" href="/login">ログイン</a>
                <a class="nav__btn" href="{{ route('mypage') }}">マイページ</a>
                @endif
                <a class="nav__btn--box" href="/sell"><span>出品</span></a>
            </div>
        </header>
        @yield('content')
    </div>
</body>
</html>