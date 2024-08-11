@extends('user.layouts.app')

@section('title', 'やさい詳細')

@section('content')
<link rel="stylesheet" href="{{ asset('css/vegetable-detail.css')}}">

<body>
    <div class="vegetable-container">
        <h1 class="vegetable-name">{{ $vegetable->name }}</h1>
        <img src="{{ asset('storage/images/' . $vegetable->image) }}" alt="" class="vegetable-image">
        <p class="vegetable-description">{{ $vegetable->description }}</p>
    </div>
    <div class="blog-details">
        @if($vegetable->blogs->isNotEmpty())
            <div class="related-blogs">
                <h2>関連するブログ記事</h2>
                @foreach($vegetable->blogs as $blog)
                    <div class="blog-details">
                        <h3>{{ $blog->title }}</h3>
                        <div class="blog-images">
                            @foreach($blog->images as $image)
                                <img src="{{ $image->image_path ? asset('storage/' . $image->image_path) : asset('images/default.png') }}"
                                    alt="ブログ画像">
                            @endforeach
                        </div>
                        <p>{{ $blog->content }}</p>
                        <div class="blog-time">
                            {{ $blog->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>この野菜に関連するブログ記事はまだありません。</p>
        @endif

    </div>

</body>
@endsection