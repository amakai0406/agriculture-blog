@extends('user.layouts.header')

@section('title', '農業ブログ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/blog-details.css') }}">

<div class="blog-details">
    <h1>{{ $blog->title }}</h1>
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
    <div class="back-link">
        <a href="/user/blogs">一覧画面へ戻る</a>
    </div>
</div>
@include('user.layouts.footer') 
@endsection