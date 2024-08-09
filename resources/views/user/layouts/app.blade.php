<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    <header class="page-header wrapper">
        <nav>
            <ul class="main-nav">
                <li><a href="{{ route('user.home.index') }}">トップページ</a></li>
                <li><a href="{{ route('user.vegetables.index') }}">やさい一覧</a></li>
                <li><a href="{{ route('user.blogs.index') }}">ブログ一覧</a></li>
                <li><a href="{{ route('user.events.index') }}">イベント一覧</a></li>
                <li><a href="{{ route('user.reservations.create') }}">農業体験予約</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>

</body>

</html>