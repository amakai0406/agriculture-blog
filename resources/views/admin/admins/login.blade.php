<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>管理車ログイン</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.admins.login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">名前</label>
                                <input type="text" class="form-control" id="name" name="name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>