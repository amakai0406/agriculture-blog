<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
    <title>Event detail</title>
</head>

<body>
    <div class="event-detail">
        <h1 class="event-title">{{ $event->title }}</h1>
        <div class="event-images">
            @foreach($event->eventImages as $eventImage)
                <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="Event Image" class="event-image">
            @endforeach
        </div>
        <p class="event-description">{{ $event->description }}</p>
        <p class="event-period">開催期間: <span>{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} ~
                {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}</span></p>
        <p class="event-participants">参加可能人数: <span>{{ $event->participants_count }}</span></p>
        <p class="event-created">イベント作成日: <span>{{ ($event->created_at)->format('Y-m-d') }}</span>
        </p>
        <div class="back-link">
            <a href="/user/events">農業体験イベント一覧へ戻る</a>
        </div>
    </div>
</body>

</html>