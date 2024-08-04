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

        $reservation->phone_number = $validated['phone_number'];

        $reservation->questions = $validated['questions'];

        $reservation->reservation_date = $validated['reservation_date'];

        $reservation->save();

        return redirect()->route('user.reservations.complete');

    }

    public function complete()
    {
        return view('user.reservations.complete');
    }
}