<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog list</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Blog List</h1>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="card blog-card">
                        <img src="{{ $blog->image }}" class="card-img-top" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</p>
                            <p class="card-text"><small class="text-muted"></small></p>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $blogs->links() }}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>