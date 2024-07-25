<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/blog-index.css') }}">
    <title>blog list</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">ブログ一覧</h1>
        <a href="/admin/blogs/create">新しいブログの投稿ページへ</a>
        <table class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: left">画像</th>
                    <th style="width: 20%; text-align: left;">タイトル</th>
                    <th style="width: 40%; text-align: left;">内容</th>
                    <th style="width: 10%; text-align: left">投稿者</th>
                    <th style="width: 15%; text-align: center">
                        <div>作成日</div>
                        <div>更新日</div>
                    </th>
                    <th style="width: 10%; text-align: center">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="blog-row">
                        <td>
                            @if($blog->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $blog->images->first()->image_path) }}"
                                    alt="{{ $blog->title }}">
                            @else 
                                <div>No image</div>

                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</td>
                        <td>{{ $blog->admin_id }}</td>
                        <td>
                            <div>{{ $blog->created_at->format('Y-m-d H:i') }}</div>
                            <div>{{ $blog->updated_at->format('Y-m-d H:i') }}</div>
                        </td>
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

</body>


</html>