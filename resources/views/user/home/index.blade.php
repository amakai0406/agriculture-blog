@extends('user.layouts.header')

@section('title', 'トップページ')

@section('content')
<link href="https://fonts.googleapis.com?family=philosopher" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

<body>
    <div id="home" class="big-bg">
        <div class="home-content wrapper">
            <h2 class="page-title">農業を楽しく体験する</h2>
            <p>農業に興味のある方に</p>
            <p>農業を始めるきっかけとなるイベントを開催したり、農業に関する情報をブログで発信</p>
        </div>
    </div>
    <!-- /#home -->
    <div class="container">
        <h2>農業体験イベント一覧</h2>
        @if($events->isEmpty())
            <p>現在イベントの予定はありません</p>
        @else
            <div class="event-list">
                @foreach($events as $event)
                    <div class="event">
                        <h2 class="event-title">{{ $event->title }}</h2>
                        <div class="event-images">
                            @foreach($event->eventImages as $eventImage)
                                <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="Event Image" class="event-image">
                            @endforeach
                        </div>
                        <p class="event-description">{{ Str::limit($event->description, 200, '...') }}</p>
                        <p class="event-period">開催日: {{ $event->event_date }}</p>
                        <p class="event-participants">参加可能人数: <span>{{ $event->participants_count }}</span></p>
                        <a href="{{ route('user.events.show', ['id' => $event->id]) }}">このイベントの詳細へ</a>
                        <div>
                            <a href="{{ route('user.reservations.byEventId', ['event_id' => $event->id]) }}">このイベントを予約</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <h2>ブログ一覧</h2>
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
                <a href="{{ route('user.blogs.show', ['id' => $blog->id])}}" class="blog-Link">このブログの詳細へ</a>
                <div>
                    {{ $blog->created_at->format('Y-m-d H:i') }}
                </div>
            </div>
        @endforeach
    </div>
    <h2>やさい一覧</h2>
    <ul class="vegetableLineup-items">
        @foreach ($vegetables as $vegetable)
            <li class="vegetableLineup-item">
                <div class="vegetableLineup-item-container">
                    <figure class="vegetableLineup-item-img">
                        <img src="{{ asset('storage/images/' . $vegetable->image) }}">
                    </figure>
                    <div class="vegetableLineup-item-body">
                        <h4 class="vegetableLineup-item-name">{{ $vegetable->name }}</h4>
                        <p><a href="{{ route('user.vegetables.show', ['id' => $vegetable->id]) }}"
                                class="vegetable-Link">このやさいの詳細へ</a></p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>


</body>
@include('user.layouts.footer') 
@endsection