<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>農業ブログ - トップページ</title>
    <link href="https://fonts.googleapis.com?family=philosopher" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    <div id="home" class="big-bg">
        <header class="page-header wrapper">
            <nav>
                <ul class="main-nav">
                    <li><a href="{{ route('user.vegetables.index') }}">やさい一覧</a></li>
                    <li><a href="{{ route('user.blogs.index') }}">ブログ一覧</a></li>
                    <li><a href="{{ route('user.events.index') }}">イベント一覧</a></li>
                    <li><a href="{{ route('user.reservation.create') }}">農業体験予約</a></li>
                </ul>
            </nav>
        </header>

        <div class="home-content wrapper">
            <h2 class="page-title">幸せになるために農業という選択を</h2>
            <p>大自然に囲まれて健康で豊かな毎日を過ごしませんか？きっと人生の価値観が変わるはず。</p>
        </div>
    </div><!-- /#home -->
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
    <div class="centered-link">
        <a href="{{ route('user.blogs.index') }}">ブログ一覧へ</a>
    </div>
    <div class="vegetableLineup-wrapper">
        <ul class="vegetableLineup-items">
            @foreach ($vegetables as $vegetable)
                <li class="vegetableLineup-item">
                    <a href="{{ route('user.vegetables.show', ['id' => $vegetable->id])}}"
                        class="vegetableLineup-item-container">
                        <figure class="vegetableLineup-item-img">
                            <img src="{{ asset('storage/images/' . $vegetable->image) }}">
                        </figure>
                        <div class="vegetableLineup-item-body">
                            <h3 class="vegetableLineup-item-name">{{ $vegetable->name }}</h3>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="centered-link">
        <a href="{{ route('user.vegetables.index') }}">やさい一覧へ</a>
    </div>
    <div class="outer-container">
        @foreach($events as $event)
            <div class="event">
                <h2 class="event-title">{{ $event->title }}</h2>
                <div class="event-images">
                    @foreach($event->eventImages as $eventImage)
                        <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="Event Image" class="event-image">
                    @endforeach
                </div>
                <p class="event-description">{{ $event->description }}</p>
                <p class="event-period">開催期間: <span>{{ $event->start_date }} ~ {{ $event->end_date }}</span></p>
                <p class="event-participants">参加可能人数: <span>{{ $event->participants_count }}</span></p>
                <a href="{{ route('user.events.show', ['id' => $event->id]) }}">このイベントの詳細へ</a>
            </div>
        @endforeach
    </div>

    <div class="centered-link">
        <a href="{{ route('user.events.index') }}">農業体験イベント一覧へ</a>
    </div>
</body>

</html>