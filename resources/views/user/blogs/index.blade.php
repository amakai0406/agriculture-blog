@section('content')
<link rel="stylesheet" href="{{ asset('css/blogs.css') }}">

<div class="blog-list">
    @foreach($blogs as $blog)
        <div class="blog-item">
            <h2>{{ $blog->title }}</h2>
            <div class="blog-images">
                @foreach($blog->images as $image)
                    <img src="" alt="Blog Image">
                @endforeach
            </div>
            <p>{{ $blog->content }}</p>
        </div>
    @endforeach
</div>