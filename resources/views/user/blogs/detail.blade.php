@section('content')
<link rel="stylesheet" href="{{ asset('css/blog-details.css') }}">

<div class="blog-details">
    <h1>{{ $blog->title }}</h1>
    <div class="blog-images">
        @foreach($blog->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Blog Image">
        @endforeach
    </div>
    <p>{{ $blog->content }}</p>
    <div class="blog-time">
        {{ $blog->created_at->format('Y-m-d H:i') }}
    </div>
</div>

<div class="back-link">
    <a href="/user/blogs">一覧画面へ戻る</a>
</div>