@extends('user.layouts.app')

@section('title', 'やさい一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/vegetable-detail.css')}}">

<body>
    <div class="vegetable-container">
        <h1 class="vegetable-name">{{ $vegetable->name }}</h1>
        <img src="{{ asset('storage/images/' . $vegetable->image) }}" alt="" class="vegetable-image">
        <p class="vegetable-description">{{ $vegetable->description }}</p>
        <div class="back-link">
            <a href="{{ route('user.vegetables.index') }}" class="return-link">やさい一覧へ戻る</a>
        </div>
    </div>
</body>
@endsection