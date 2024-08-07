@extends('user.layouts.app')

@section('title', 'やさいのラインナップ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/vegetable-index.css') }}">
<h2>やさいのラインナップ</h2>
<ul class="vegetableLineup-items">
    @foreach ($vegetables as $vegetable)
        <li class="vegetableLineup-item">
            <a href="{{ route('user.vegetables.show', ['id' => $vegetable->id])}}" class="vegetableLineup-item-container">
                <figure class="vegetableLineup-item-img">
                    <img src="{{ asset('storage/images/' . $vegetable->image) }}">
                </figure>
                <div class="vegetableLineup-item-body">
                    <h3 class="vegetableLineup-item-name">{{ $vegetable->name }}</h3>
                </div>
            </a>
        </li>
    @endforeach
</ul>
@endsection