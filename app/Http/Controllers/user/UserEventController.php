<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;


class UserEventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view('user.events.index', compact('events'));
    }

    public function show(int $id)
    {
        $event = Event::findOrFail($id);

        return view('user.events.detail', compact('event'));
    }
}