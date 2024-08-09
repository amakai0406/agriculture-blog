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

        $filteredEvents = Event::where('event_date', '>', $currentDateTime)->get();

        return view('user.reservations.create', compact('filteredEvents'));
    }

    public function reservationsByEventId($event_id)
    {
        // 特定のイベントを取得
        $event = Event::findOrFail($event_id);

        // 選択されたイベントと、その他の全てのイベントを取得
        $currentDateTime = now();
        $filteredEvents = Event::where('event_date', '>', $currentDateTime)->get();

        // ビューにイベントデータを渡す
        return view('user.reservations.create', compact('event', 'filteredEvents'));
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