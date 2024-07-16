<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog list</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">ブログ一覧</h1>
        <table class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: left">画像</th>
                    <th style="width: 20%; text-align: left;">タイトル</th>
                    <th style="width: 40%; text-align: left;">内容</th>
                    <th style="width: 10%; text-align: left">作成日</th>
                    <th style="width: 10%; text-align: left">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="blog-row">
                        <td>
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" style="width: 100%; height: auto;">
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    </div>
    <style>
        .blog-row td {
            padding: 15px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>