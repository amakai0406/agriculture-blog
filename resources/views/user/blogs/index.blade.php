@extends('user.layouts.app')

@section('title', 'ブログ一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blogs.css') }}">

<div class="blog-list">
    @foreach($blogs as $blog)
        <a href="{{ route('user.blogs.show', ['id' => $blog->id])}}" class="blog-Link">
            <div class="blog-item">
                <h2>{{ $blog->title }}</h2>
                <div class="blog-images">
                    @foreach($blog->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Blog Image">
                    @endforeach
                </div>
                <p>{{ $blog->content }}</p>
                <div>
                    {{ $blog->created_at->format('Y-m-d H:i') }}
                </div>
            </div>
        </a>
    @endforeach
</div>
<!-- ページネーション -->
{{ $blogs->links() }}
@endsection