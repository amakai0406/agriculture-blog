<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/admin/blog-index.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="my-4">ブログ一覧</h1>
        <div class="link-container">
            <a href="/admin/blogs/create">新しいブログの投稿ページへ</a>
        </div>
        @if (session('success'))
            <div class="alert-container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <table class="table table-bordered blog-table">
            <thead>
                <tr>
                    <th>画像</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>作成日</th>
                    <th>更新日</th>
                    <th>編集</th>
                    <th>投稿者</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $blog->images->first()->image_path) }}"
                                    alt="{{ $blog->title }}" class="blog-image">
                            @else 
                                <div>No image</div>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td class="desc-column">{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $blog->updated_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', ['id' => $blog->id]) }}">編集</a>
                        </td>
                        <td>{{ $admin->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $blogs->links() }}
        </div>
        <div class="link-container">
            <a href="/admin/dashboard">トップページへ</a>
        </div>
    </div>
</body>

</html>
