<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetables</title>
    <link rel="stylesheet" href="{{ asset('css/vegetable-detail.css')}}">
</head>

<body>
    <div class="vegetable-container">
        <h1 class="vegetable-name">{{ $vegetable->name }}</h1>
        <img src="{{ asset('storage/images/' . $vegetable->image) }}" alt="" class="vegetable-image">
        <p class="vegetable-description">{{ $vegetable->description }}</p>
    </div>
</body>

<a href="{{ route('user.vegetables.index') }}" class="return-link">やさい一覧へ戻る</a>

</html>