@extends('user.layouts.header')

@section('title', '予約入力フォーム')

@section('content')
<link rel="stylesheet" href="/css/reservation-create.css">
<div class="container">
    <h1>予約入力フォーム</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.reservations.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="event_id">イベント</label>
            <select id="event_id" name="event_id" required>
                <option value="">イベントを選択してください</option>
                @foreach ($filteredEvents as $eventOption)
                    <option value="{{ $eventOption->id }}" {{ isset($event) && $event->id == $eventOption->id ? 'selected' : '' }}>
                        {{ $eventOption->title }} ({{ \Carbon\Carbon::parse($eventOption->event_date)->format('Y-m-d') }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="representative_name">予約者名</label>
            <input type="text" id="representative_name" name="representative_name"
                value="{{ old('representative_name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">電話番号</label>
            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
        </div>
        <button type="submit">予約する</button>
    </form>
</div>
@include('user.layouts.footer') 
@endsection