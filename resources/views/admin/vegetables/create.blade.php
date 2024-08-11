<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>やさい作成</title>
    <link rel="stylesheet" href="{{ asset('css/admin/vegetable-create.css')}}">
</head>

<body>
    <div class="container">
        <h1 class="my-4">やさいを追加する</h1>

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

        <form action="{{ route('admin.vegetables.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">画像</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required
                    onchange="previewImage(event)">
                <img id="image-preview" style="display: none; width: 200px; margin-top: 20px;">
            </div>

            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
    <script>
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

</html>