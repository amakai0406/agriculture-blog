<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reservation Form</title>
    <link rel="stylesheet" href="/css/reservation-create.css">
</head>

<body>
    <div class="container">
        <h1>予約入力フォーム</h1>
        <form action="/submit-reservation" method="post">
            @csrf
            <div class="form-group">
                <label for="event_id">イベント</label>
                <select id="event_id" name="event_id" required>
                    <option value="">イベントを選択してください</option>
                    @foreach ($filteredEvents as $event)
                        <option value="{{ $event->id }}">
                            {{ $event->title }} ({{ $event->start_date->format('Y-m-d H:i') }} -
                            {{ $event->end_date->format('Y-m-d H:i') }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="representative_name">予約者名</label>
                <input type="text" id="representative_name" name="representative_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">電話番号</label>
                <input type="tel" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="questions">質問事項</label>
                <textarea id="questions" name="questions" required></textarea>
            </div>
            <div class="form-group">
                <label for="reservation_date">予約希望日</label>
                <input type="datetime-local" id="reservation_date" name="reservation_date" required>
            </div>
            <button type="submit">Submit Reservation</button>
        </form>
    </div>
</body>

</html>