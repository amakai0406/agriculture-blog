@extends('admin.layouts.app')

@section('title', 'イベント編集')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/event-edit.css') }}">

@include('admin.layouts.header')


<body>
    <div class="container">
        <h1>農業体験イベント編集</h1>
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
                <label for="event_date">イベント開催日</label>
                <input type="date" id="start_date" name="event_date" value="{{ $event->event_date }}" required>
            </div>

            <div class="form-group spacing-between-vegetables-and-image">
                <label for="event_image">イベント画像</label>
                @if ($event->eventImages->isNotEmpty())
                    @foreach($event->eventImages as $eventImage)
                        @if($eventImage->location == 'main')
                            <img id="eyecatch-image" src="{{ asset('storage/' . $eventImage->image_path) }}"
                                alt="{{ $event->title }} - eyecatch Image" class="event-image">
                        @elseif($eventImage->location == 'content')
                            <div>
                                <img id="content-image" src="{{ asset('storage/' . $eventImage->image_path) }}" alt=""
                                    class="event-image">
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

            <select name="location" class="form-control">
                <option value="main" {{ $event->location == 'main' ? 'selected' : '' }}>メイン画像</option>
                <option value="content" {{ $event->location == 'content' ? 'selected' : '' }}>イベント内容で表示する画像
                </option>
            </select>

            <div class="form-group">
                <button class="update-btn">更新</button>
            </div>

        </form>

        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
            </div>
        </form>

        <div>
            <a href="/admin/events">農業体験イベントへ戻る</a>
        </div>
    </div>
</body>
<script>
    document.getElementById('new_image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // どの位置に表示するかを判定
                const selectedLocation = document.querySelector('select[name="location"]').value;

                let previewImage;
                if (selectedLocation === 'main') {
                    previewImage = document.getElementById('eyecatch-image');
                } else if (selectedLocation === 'content') {
                    previewImage = document.getElementById('content-image');
                }

                if (previewImage) {
                    previewImage.src = e.target.result;
                } else {
                    // プレビュー画像が存在しない場合、画像要素を追加
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.className = 'event-image';
                    imgElement.id = selectedLocation === 'main' ? 'eyecatch-image' : 'content-image';
                    const imageContainer = document.querySelector('.form-group.spacing-between-vegetables-and-image');
                    imageContainer.appendChild(imgElement);
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@include('admin.layouts.footer') 
@endsection