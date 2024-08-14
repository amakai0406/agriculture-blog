<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div>ユーザ名: {{ $admin->name }}</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">野菜管理</div>
                    <div class="card-body">
                        <a href="/admin/vegetables" class="btn btn-light">一覧を表示する</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">ブログ管理</div>
                    <div class="card-body">
                        <a href="/admin/blogs" class="btn btn-light">一覧を表示する</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">体験イベント管理</div>
                    <div class="card-body">
                        <a href="/admin/events" class="btn btn-light">一覧を表示する</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">予約管理</div>
                    <div class="card-body">
                        <a href="/admin/reservations" class="btn btn-light">一覧を表示する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>