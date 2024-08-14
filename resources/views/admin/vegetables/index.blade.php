@extends('admin.layouts.app')

@section('title', 'やさい一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/vegetable-index.css') }}">

<body>
    <div class="container">
        <h1 class="my-4">やさい一覧</h1>
        <div class="link-container">
            <a href="/admin/vegetables/create">やさいを追加する</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>画像</th>
                    <th>名前</th>
                    <th>説明</th>
                    <th>作成日</th>
                    <th>更新日</th>
                    <th>編集</th>
                    <th>作成者</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vegetables as $vegetable)
                    <tr>
                        <td>
                            @if(!empty($vegetable->image))
                                <img src="{{ asset('storage/images/' . $vegetable->image) }}" alt="{{ $vegetable->name }}"
                                    style="max-width: 200px;">
                            @else 
                                <div>No image</div>
                            @endif
                        </td>
                        <td>{{ $vegetable->name }}</td>
                        <td class="desc-column">{{ \Illuminate\Support\Str::limit($vegetable->description, 100, '...') }}
                        </td>
                        <td>{{ $vegetable->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $vegetable->updated_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.vegetables.edit', ['id' => $vegetable->id]) }}">編集</a>
                        </td>
                        <td>{{ $admin->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="link-container">
            <a href="/admin/dashboard">トップページへ</a>
        </div>
    </div>
</body>
@endsection