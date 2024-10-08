@extends('admin.layouts.app')

@section('title', 'ブログの作成')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/blog-create.css') }}">

@include('admin.layouts.header')


<body>
    <div class="container">
        <h1>ブログ作成</h1>

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
                <label for="vegetables">関連する野菜</label>
                <div class="custom-dropdown">
                    <input type="checkbox" id="dropdown-checkbox" class="dropdown-checkbox">
                    <label for="dropdown-checkbox" class="dropdown-label">野菜を選択</label>
                    <div class="dropdown-content">
                        <div class="checkbox-group" id="vegetables">
                            @foreach($vegetables as $vegetable)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="vegetable{{ $vegetable->id }}"
                                        name="vegetable_ids[]" value="{{ $vegetable->id }}"
                                        onchange="updateSelectedVegetables()">
                                    <label class="form-check-label"
                                        for="vegetable{{ $vegetable->id }}">{{ $vegetable->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div id="selected-vegetables" class="selected-vegetables"></div>

            <div class="form-group">
                <label for="image">画像</label>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
                <img id="image-preview" style="display:none;">
            </div>

            <div class="form-group">
                <label for="location">表示場所</label>
                <select name="location" id="location" class="form-control">
                    <option value="" disabled selected>選択してください</option>
                    <option value="eyecatch">アイキャッチ画像</option>
                    <option value="content">イベント内容で表示する画像</option>
                </select>
            </div>

            <button type="submit">ブログを投稿する</button>
        </form>
    </div>

    <script>
        function updateSelectedVegetables() {
            const selectedContainer = document.getElementById('selected-vegetables');
            selectedContainer.innerHTML = '';

            document.querySelectorAll('.form-check-input:checked').forEach(function (checkedBox) {
                const vegetableSpan = document.createElement('span');
                vegetableSpan.textContent = checkedBox.nextElementSibling.textContent;
                selectedContainer.appendChild(vegetableSpan);
            });
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
@include('admin.layouts.footer') 
@endsection