<!DOCTYPE html>
<html lang="ja">

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
        @if (session('success'))
            <div class="alert-container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <table class="table table-striped blog-table">
            <thead>
                <tr>
                    <th class="table-image">画像</th>
                    <th class="table-title">タイトル</th>
                    <th class="table-content">内容</th>
                    <th class="table-author">投稿者</th>
                    <th class="table-dates">
                        <div>作成日</div>
                        <div>更新日</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="blog-row">
                        <td colspan="5" class="p-0">
                            <a href="{{ route('admin.blogs.edit', ['id' => $blog->id]) }}" class="blog-link">
                                <table class="inner-table">
                                    <tr>
                                        <td class="table-image">
                                            @if($blog->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $blog->images->first()->image_path) }}"
                                                    alt="{{ $blog->title }}">
                                            @else 
                                                <div>No image</div>
                                            @endif
                                        </td>
                                        <td class="table-title">{{ $blog->title }}</td>
                                        <td class="table-content">{{ \Illuminate\Support\Str::limit($blog->content, 100) }}
                                        </td>
                                        <td class="table-author">{{ $admin->name }}</td>
                                        <td class="table-dates">
                                            <div>{{ $blog->created_at->format('Y-m-d H:i') }}</div>
                                            <div>{{ $blog->updated_at->format('Y-m-d H:i') }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $blogs->links() }}
        </div>
    </div>
</body>

</html>