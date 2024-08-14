@extends('user.layouts.header')

@section('title', 'やさい一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/vegetable-index.css') }}">
<h2>やさい一覧</h2>
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
@include('user.layouts.footer') 
@endsection