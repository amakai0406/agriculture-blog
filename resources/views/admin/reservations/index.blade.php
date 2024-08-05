<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reservations</title>
    <link rel="stylesheet" href="{{ asset('css/admin/reservation-index.css') }}">
</head>

<body>
    <div class="container">
        <h1>農業体験イベント予約一覧</h1>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>イベント名</th>
                    <th>代表者名</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>予約日</th>
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
                        <td>{{ $eventReservation->reservation_date }}</td>
                        <td>{{ $eventReservation->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>