@extends('user.layouts.app')

@section('title', '農業体験イベントの詳細')

@section('content')
<link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">

<div class="event-detail">
    <h1 class="event-title">{{ $event->title }}</h1>
    <div class="event-images">
        @foreach($event->eventImages as $eventImage)
            <img src="{{ asset('storage/' . $eventImage->image_path) }}" alt="Event Image" class="event-image">
        @endforeach
    </div>
    <p class="event-description">{{ $event->description }}</p>
    <p class="event-period">開催期間:{{ $event->start_date }}</p>
    <p class="event-participants">参加可能人数: <span>{{ $event->participants_count }}</span></p>
    <p class="event-created">イベント作成日: <span>{{ ($event->created_at)->format('Y-m-d') }}</span>
    </p>
    <a href="{{ route('user.reservations.byEventId', ['event_id' => $event->id]) }}">このイベントを予約</a>
    <div class="back-link">
        <a href="/user/events">農業体験イベント一覧へ戻る</a>
    </div>
</div>
@endsection