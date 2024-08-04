<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;

class UserReservationController extends Controller
{

    public function create()
    {

        //現在の時刻の取得
        $currentDateTime = now();

        $events = Event::all();

        $filteredEvents = $events->filter(function ($event) use ($currentDateTime) {
            return $event->start_date <= $currentDateTime && $event->end_date >= $currentDateTime;
        });

        //dd($filteredEvents);

        return view('user.reservations.create', compact('filteredEvents'));
    }
}