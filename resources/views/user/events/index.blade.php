@extends('user.layouts.app')

@section('title', '農業体験イベント一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/event-index.css') }}">

<div class="container">
    <h1>農業体験イベント一覧</h1>
    @if($events->isEmpty())
        <p>現在イベントの予定はありません</p>
    @else
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
    @endif
</div>
@endsection