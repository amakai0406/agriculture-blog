<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理者ページ')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
</head>

<body>
    <div class="wrapper">
        <aside class="sidebar">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">ダッシュボード</a></li>
                <li><a href="{{ route('admin.events.index') }}">イベント管理</a></li>
                <li><a href="{{ route('admin.blogs.index') }}">ブログ管理</a></li>
                <li><a href="{{ route('admin.vegetables.index') }}">野菜管理</a></li>
                <li><a href="{{ route('admin.reservations.index') }}">予約管理</a></li>
                <li><a href="{{ route('admin.create') }}">管理者作成</a></li>
            </ul>
        </aside>

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>

</html>