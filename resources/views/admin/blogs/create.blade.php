<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .container h1 {
        font-size: 2em;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group label {
        font-size: 1.5em;
        display: block;
        text-align: center;
    }

    .form-control,
    .form-control-file,
    .form-control textarea {
        font-size: 1.5em;
        height: auto;
        padding: 10px;
        margin: 0 auto;
        display: block;
        text-align: center;
    }

    .btn-primary {
        font-size: 1.5em;
        padding: 10px 20px;
        display: block;
        width: 100%;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <h1>新しいブログを作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
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
            <div>
                <label for="title">タイトル</label>
            </div>
            <div>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
        </div>


        <div class="form-group">
            <div>
                <label for="content">内容</label>
            </div>
            <div>
                <textarea class="form-control" id="content" name="content" rows="5"
                    required>{{ old('content') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="image">画像</label>
            </div>
            <div>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">投稿</button>
    </form>
</div>