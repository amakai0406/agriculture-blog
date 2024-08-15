<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトのタイトル')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/footer.css') }}">
</head>

<body>
    <footer class="site-footer">
        <div class="footer-container">
            <p>&copy; 2024 農業体験イベント ブログ. </p>
        </div>
    </footer>
    <div class="content">
        @yield('content')
    </div>

</body>

</html>