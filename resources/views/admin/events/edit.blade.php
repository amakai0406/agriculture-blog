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
                <label for="event_date">開催日</label>
                <input type="date" id="start_date" name="event_date" value="{{ $event->event_date }}" required>
            </div>

            @foreach($event->eventImages as $eventImage)
                <div class="form-group">
                    <label for="location">画像の表示場所</label>
                    <select class="form-control" id="location" name="location" required>
                        <option value="" disabled>画像の表示場所を選択してください</option>
                        <option value="eyecatch" {{ $eventImage->location == 'eyecatch' ? 'selected' : '' }}>アイキャッチ画像</option>
                        <option value="content" {{ $eventImage->location == 'content' ? 'selected' : '' }}>イベント内容の中で表示する画像
                        </option>
                    </select>
                </div>
            @endforeach


            <div class="form-group spacing-between-vegetables-and-image">
                <label for="event_image">イベント画像</label>
                @if ($event->eventImages->isNotEmpty())
                    @foreach($event->eventImages as $eventImage)
                        @if($eventImage->location == 'アイキャッチ画像')
                            <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="{{ $event->title }} - eyecatch Image"
                                class="event-image">
                        @elseif($eventImage->location == 'イベント内容の中で表示する画像')
                            <div>
                                <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="" class="event-image">
                            </div>
                        @endif
                    @endforeach
                @else 
                    <div>No image</div>
                @endif
            </div>
            <div class="form-group">
                <input type="file" class="form-control" id="new_image" name="event_image">
            </div>

            <div class="form-group">
                <button type="submit" class="update-button">更新</button>
            </div>

        </form>

        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？')">削除</button>
            </div>
        </form>

        <div>
            <a href="/admin/events">農業体験イベントへ戻る</a>
        </div>
    </div>
</body>

</html>