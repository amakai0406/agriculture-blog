<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <link rel="stylesheet" href="{{ asset('css/admin/blog-create.css') }}">
</head>

<body>
    <div class="container">
        <h1>新しいブログを投稿する</h1>

        @if ($errors->any())
            <div class="alert alert-danger custom-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">ブログ内容</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">画像</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit">ブログを投稿する</button>
        </form>
    </div>
</body>

</html>