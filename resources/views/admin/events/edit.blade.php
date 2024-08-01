<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント編集</title>
    <link rel="stylesheet" href="{{ asset('css/admin/event-edit.css') }}">
</head>

<body>
    <div class="container">
        <h1>イベント編集</h1>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="{{ $event->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_date">開始日</label>
                <input type="date" id="start_date" name="start_date" value="{{ $event->start_date }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">終了日</label>
                <input type="date" id="end_date" name="end_date" value="{{ $event->end_date }}" required>
            </div>

            <div class="form-group">
                <label for="participants_count">参加者数</label>
                <input type="number" id="participants_count" name="participants_count"
                    value="{{ $event->participants_count }}" required>
            </div>

            <div class="form-group">
                <label for="event_image">イベント画像</label>
                <input type="file" id="event_image" name="event_image">
            </div>

            <div class="form-group">
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</body>

</html>