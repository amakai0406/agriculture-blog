<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント一覧</title>
    <link rel="stylesheet" href="{{ asset('css/admin/event-index.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="my-4">農業体験イベント一覧</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('admin.events.create') }}">新しいイベントを追加する</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>イベント内容</th>
                    <th>開催日</th>
                    <th>参加可能人数</th>
                    <th>作成日</th>
                    <th>更新日</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($event->description, 100) }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}
                        </td>

                        </td>
                        <td>
                            <a
                                href="{{ route('admin.reservations.show', ['eventId' => $event->id]) }}">{{ $event->reserved_participants }}</a>
                        </td>
                        <td>{{ $event->created_at }}</td>
                        <td>{{ $event->updated_at }}</td>
                        <td>
                            <a href="{{route('admin.events.edit', ['id' => $event->id]) }}">編集</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>