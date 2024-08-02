<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vegetable</title>
    <link rel="stylesheet" href="{{ asset('css/admin/vegetable-edit.css') }}">
</head>

<body>
    <div class="container">
        <h1>やさいの編集</h1>
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
        <div class="link-container">
            <a href="{{ route('admin.vegetables.index') }}">やさい一覧へ戻る</a>
        </div>
        <form action="{{ route('admin.vegetables.update', $vegetable->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="{{ $vegetable->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" rows="4" required>{{ $vegetable->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">画像</label>
                @if ($vegetable->image)
                    <img src="{{ asset('storage/' . $vegetable->image) }}" alt="" class="vegetable-image">
                @else
                    <p>画像がありません</p>
                @endif
            </div>
            <div class="form-group">
                <input type="file" class="form-control" id="new_image" name="image">
            </div>
            <div class="form-group">
                <button type="submit" class="update-btn">更新する</button>
            </div>
        </form>
        <form action="{{ route('admin.vegetables.destroy', $vegetable->id) }}" method="post" class="delete-form">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <button type="submit" class="delete-btn">削除する</button>
            </div>
        </form>
    </div>
</body>

</html>