@extends('admin.layouts.app')

@section('title', 'イベント作成')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/event-create.css') }}">

@include('admin.layouts.header')

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
                <label for="event_date">イベント開催日</label>
                <input type="date" class="form-control" id="event_date" name="event_date"
                    value="{{ old('event_date') }}" required>
            </div>
            <div class="form-group">
                <label for="participants_count">参加人数</label>
                <input type="number" class="form-control" id="participants_count" name="participants_count"
                    value="{{ old('participants_count') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="event_image">イベント画像</label>
                <input type="file" class="form-control-file" id="event_image" name="event_image" accept="image/*">
                <img id="image_preview" src="#" alt="画像プレビュー"
                    style="max-width: 30%; display: none; margin-top: 10px;" />
            </div>
            <div class="form-group">
                <label for="location">表示場所</label>
                <select name="location" id="location" class="form-control">
                    <option value="" disabled selected>選択してください</option>
                    <option value="main">メイン画像</option>
                    <option value="content">イベント内容で表示する画像</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
</body>
<script>
    document.getElementById('event_image').addEventListener('change', function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('image_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@include('admin.layouts.footer') 
@endsection