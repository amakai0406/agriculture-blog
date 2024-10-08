@extends('user.layouts.header')

@section('title', 'ブログ一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blog-index.css') }}">

<h1 class="centered-title">ブログ一覧</h1>
<div class="blog-list">
    @foreach($blogs as $blog)
        <div class="blog-item">
            <h2>{{ $blog->title }}</h2>
            <div class="blog-images">
                @foreach($blog->images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Blog Image">
                @endforeach
            </div>
            <p>{{ \Illuminate\Support\Str::limit($blog->content, 100, '...') }}</p>
            <a href="{{ route('user.blogs.show', ['id' => $blog->id])}}" class="blog-link">このブログの詳細へ</a>
            <div>
                {{ $blog->created_at->format('Y-m-d H:i') }}
            </div>
        </div>
    @endforeach
</div>
<!-- ページネーション -->
{{ $blogs->links() }}
@include('user.layouts.footer') 
@endsection