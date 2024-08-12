<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント作成</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/event-create.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="my-4">農業体験イベント作成</h1>
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @csrf

            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="description">イベント内容</label>
                <textarea class="form-control" id="description" name="description" rows="5"
                    required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="event_date">開始日</label>
                <input type="date" class="form-control" id="event_date" name="event_date"
                    value="{{ old('event_date') }}" required>
            </div>
            <div class="form-group">
                <label for="location">画像の表示場所</label>
                <select class="form-control" id="location" name="location" required>
                    <option value="" disabled selected>画像の表示場所を選択してください</option>
                    <option value="アイキャッチ画像" {{ old('location') == 'アイキャッチ画像' ? 'selected' : '' }}>アイキャッチ画像</option>
                    <option value="イベント内容の中で表示する画像" {{ old('location') == 'イベント内容の中で表示する画像' ? 'selected' : '' }}>
                        イベント内容の中で表示する画像</option>
                </select>
            </div>
            <div class="form-group">
                <label for="event_image">イベント画像</label>
                <input type="file" class="form-control-file" id="event_image" name="event_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
</body>

</html>