<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\StoreReservationRequest;
use App\Models\EventReservation;

class UserReservationController extends Controller
{

    public function create()
    {

        //現在の時刻の取得
        $currentDateTime = now();

        $events = Event::all();

        //現在の時刻がイベント終了日を過ぎていないイベントをフィルタリング
        //イベントコレクション(複数のオブジェクト)　filter()フィルタリング use()で関数外の変数を使える　>=以上
        $filteredEvents = $events->filter(function ($event) use ($currentDateTime) {
            return $event->end_date >= $currentDateTime;
        });


        return view('user.reservations.create', compact('filteredEvents'));
    }

    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();

        $reservation = new EventReservation;

        $reservation->event_id = $validated['event_id'];

        $reservation->representative_name = $validated['representative_name'];

        $reservation->email = $validated['email'];

        $reservation->phone_number = $validated['phone_number'];

        $reservation->reservation_date = $validated['reservation_date'];

        $reservation->status = 'confirmed';

        $reservation->save();

        return redirect()->route('user.reservations.complete');

    }

    public function complete()
    {
        return view('user.reservations.complete');
    }
}