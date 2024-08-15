@extends('admin.layouts.app')

@section('title', '予約一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/reservation-index.css') }}">

@include('admin.layouts.header')

<body>
    <div class="container">
        <h1>農業体験イベント予約一覧</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger custom-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>イベント名</th>
                    <th>予約者名</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>予約日</th>
                    <th>申込日</th>
                    <th>予約状況</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventReservations as $eventReservation)
                    <tr>
                        <td>{{ $eventReservation->event->title }}</td>
                        <td>{{ $eventReservation->representative_name }}</td>
                        <td>{{ $eventReservation->phone_number }}</td>
                        <td>{{ $eventReservation->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($eventReservation->reservation_date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($eventReservation->created_at)->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('admin.reservations.update', $eventReservation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="confirmed" {{ $eventReservation->status == 'confirmed' ? 'selected' : '' }}>確定</option>
                                    <option value="cancelled" {{ $eventReservation->status == 'cancelled' ? 'selected' : '' }}>キャンセル</option>
                                </select>
                                <button type="submit">更新</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@include('admin.layouts.footer') 
@endsection