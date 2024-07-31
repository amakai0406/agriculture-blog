<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\admin\StoreEventRequest;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        Event::create($validated);

        return redirect()->route('admin.events/index')->with('success', '新しいイベントを追加しました');
    }
}

