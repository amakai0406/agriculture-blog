<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/event-index.css') }}">
    <title>Events List</title>
</head>

<body>
    <div class="container">
        <h1>農業体験イベント一覧</h1>
        @foreach($events as $event)
            <div class="event">
                <h2 class="event-title">{{ $event->title }}</h2>
                <div class="event-images">
                    @foreach($event->eventImages as $eventImage)
                        <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="Event Image" class="event-image">
                    @endforeach
                </div>
                <p class="event-description">{{ $event->description }}</p>
                <p class="event-period">開催期間: <span>{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} ~
                        {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}</span></p>

                <p class="event-participants">参加可能人数: <span>{{ $event->participants_count }}</span></p>
                <a href="{{ route('user.events.show', ['id' => $event->id]) }}">このイベントの詳細へ</a>
            </div>
        @endforeach
    </div>
</body>

</html>