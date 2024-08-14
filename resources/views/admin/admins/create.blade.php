@extends('admin.layouts.app')

@section('title', '管理者登録')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<body>
    <div class="container mt-5">
        <h2>管理者新規登録</h2>

        @if (session('success'))
            <div style="text-align: center;">
                <span
                    style="background-color: #dff0d8; color: #3c763d; padding: 5px 10px; border: 1px solid #d6e9c6; border-radius: 5px; font-size: 16px;">
                    {{ session('success') }}
                </span>
            </div>
        @endif



        <form action="{{route('admin.admins.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
</body>
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('previewImage');
        const noImageSrc = preview.getAttribute('data-noimage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.width = '100px';
                preview.style.height = '100px';
                preview.style.objectFit = 'cover';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = noImageSrc;
        }
    });
</script>
@endsection