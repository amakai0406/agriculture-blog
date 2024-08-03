<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserReservationController extends Controller
{

    public function create()
    {
        return view('user.reservations.create');
    }
}