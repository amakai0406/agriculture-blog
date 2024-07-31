<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/event-create.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="my-4">農業体験イベント作成</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">イベント内容</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">開始日</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">終了日</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="participants_count">参加人数</label>
                <input type="number" class="form-control" id="participants_count" name="participants_count" min="0"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
</body>

</html>