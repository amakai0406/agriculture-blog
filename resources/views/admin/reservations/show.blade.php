@extends('admin.layouts.app')

@section('title', '各イベント予約一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/reservation-index.css') }}">
</head>

<body>
    <div class="container">
        <h1>イベント参加者一覧</h1>

        @if ($eventReservations->isEmpty())
            <p>このイベントに対する予約はありません。</p>
        @else
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>予約者名</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>予約日</th>
                        <th>申込日</th>
                        <th>予約状況</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventReservations as $reservation)
                        <tr>
                            <td>{{ $reservation->representative_name }}</td>
                            <td>{{ $reservation->phone_number }}</td>
                            <td>{{ $reservation->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->created_at)->format('Y-m-d') }}</td>
                            <td>{{ $reservation->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('admin.events.index') }}">イベント一覧に戻る</a>
    </div>
</body>
@endsection