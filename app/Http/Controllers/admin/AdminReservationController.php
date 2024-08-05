<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventReservation;
use App\Models\Event;

class AdminReservationController extends Controller
{

    public function index()
    {
        $eventReservations = EventReservation::with('event')->get();

        return view('admin.reservations.index', compact('eventReservations'));
    }
}
