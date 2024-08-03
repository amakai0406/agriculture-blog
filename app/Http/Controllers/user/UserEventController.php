<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class UserEventController extends Controller
{

    public function index()
    {
        return view('user.events.index');
    }

    public function show()
    {
        return view('user.events.show');
    }
}