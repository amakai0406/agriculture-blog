<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vegetables List</title>
    <link rel="stylesheet" href="{{ asset('css/vegetable-index.css') }}">
</head>

<body>
    <ul class="vegetableLineup-items row row-cols-2 row-cols-sm-3 row-cols-lg-4">
        @foreach ($vegetables as $vegetable)
            <li class="vegetableLineup-item">
                <a href="{{ route('user.vegetables.show', ['id' => $vegetable->id])}}"
                    class="vegetableLineup-item-container">
                    <figure class="vegetableLineup-item-img">
                        <img src="{{ asset('storage/images/' . $vegetable->image) }}">

                    </figure>
                    <div class=" vegetableLineup-item-body">
                        <h3 class="vegetableLineup-item-name">{{ $vegetable->name }}</h3>
                        <div>
                </a>
            </li>
        @endforeach
    </ul>
</body>

</html>