@extends('admin.layouts.app')

@section('title', 'ダッシュボード')

@include('admin.layouts.header')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

<section class="event-section">
    <h2>今後の農業体験イベント予定</h2>
    <table class="event-table">
        <thead>
            <tr>
                <th>イベント名</th>
                <th>開催日</th>
                <th>参加人数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->reserved_participants }}人</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<section class="blog-stats-section">
    <h2>月別ブログ投稿数</h2>
    <table class="blog-stats-table">
        <thead>
            <tr>
                <th>月</th>
                <th>投稿数</th>
            </tr>
        </thead>
        @foreach($blogCounts as $count)
            <tr>
                <td>{{ $count->month }}</td>
                <td>{{ $count->blog_count }}</td>
            </tr>
        @endforeach
    </table>
</section>

<section class="navigation-section">
    <h2>操作</h2>
    <div class="nav-buttons">
        <a href="{{ route('admin.events.index') }}" class="btn">イベント一覧</a>
        <a href="{{ route('admin.events.create') }}" class="btn">イベント作成</a>
        <a href="{{ route('admin.blogs.index') }}" class="btn">ブログ一覧</a>
        <a href="{{ route('admin.blogs.create') }}" class="btn">ブログ作成</a>
        <a href="{{ route('admin.vegetables.index') }}" class="btn">野菜一覧</a>
        <a href="{{ route('admin.vegetables.create') }}" class="btn">野菜作成</a>
        <a href="{{ route('admin.reservations.index') }}" class="btn">予約一覧</a>
    </div>
</section>

@include('admin.layouts.footer')

@endsection