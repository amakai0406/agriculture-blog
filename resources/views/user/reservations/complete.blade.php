@extends('user.layouts.header')

@section('title', '予約完了')

@section('content')
<link rel="stylesheet" href="/css/reservation-complete.css">

<div class="container">
    <h1>予約受付完了</h1>
    <p>ご予約ありがとうございます。予約が完了いたしました。</p>
    <a href="{{ route('user.events.index') }}" class="btn">農業体験イベント一覧へ戻る</a>
</div>


</html>

@endsection