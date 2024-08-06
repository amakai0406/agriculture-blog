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
                        <td>
                            <form action="{{ route('admin.reservations.update', $eventReservation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="confirmed" {{ $eventReservation->status == 'confirmed' ? 'selected' : '' }}>確定</option>
                                    <option value="cancelled" {{ $eventReservation->status == 'cancelled' ? 'selected' : '' }}>キャンセル</option>
                                    <option value="pending" {{ $eventReservation->status == 'pending' ? 'selected' : '' }}>保留
                                    </option>
                                    <option value="completed" {{ $eventReservation->status == 'completed' ? 'selected' : '' }}>完了</option>
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


</html>