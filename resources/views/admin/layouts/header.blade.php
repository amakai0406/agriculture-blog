<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトのタイトル')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/header.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light header">
        <div>ユーザ名: {{ $admin->name }}</div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins.logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('admin.admins.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>