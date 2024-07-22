<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetables List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="my-4">やさい一覧</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>説明</th>
                    <th>画像</th>
                    <th>作成日</th>
                    <th>更新日</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vegetables as $vegetable)
                    <tr>
                        <td>{{ $vegetable->name }}</td>
                        <td>{{ $vegetable->description }}</td>
                        <td><img src="{{ asset('storage/images/' . $vegetable->image) }}" alt="{{ $vegetable->name }}"
                                style="width: 100px; height: auto; display: block;"></td>
                        <td>{{ $vegetable->created_at }}</td>
                        <td>{{ $vegetable->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <a href="/admin/vegetables/create">やさいを追加する</a>
        </div>
        <div>
            <a href="/admin/dashboard">トップページへ</a>
        </div>
    </div>
</body>

</html>