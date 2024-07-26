<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/blog-edit.css') }}">
    <title>Blog Edit</title>
</head>

<body>
    <div class="container mt-5 blog-detail">
        <h1 class="mb-4">ブログの編集</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger custom-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{route('admin.blogs.index') }}">ブログ一覧へ戻る</a>
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">ブログ内容</label>
                <textarea class="form-control blog-content" id="content" name="content" rows="5"
                    required>{{ $blog->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">画像</label>
                @if($blog->images->isNotEmpty())
                    <div>
                        <img src="{{ asset('storage/' . $blog->images->first()->image_path) }}" alt="{{ $blog->title }}">
                    </div>
                @else 
                    <div>No image</div>
                @endif
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary custom-spacing">更新する</button>
        </form>
        <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
    </div>
</body>

</html>