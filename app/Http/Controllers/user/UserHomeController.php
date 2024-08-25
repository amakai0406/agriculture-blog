<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Vegetable;
use App\Models\Event;

class UserHomeController extends Controller
{

    public function index()
    {

        $blogs = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $vegetables = Vegetable::orderBy('created_at', 'desc')->take(3)->get();
        $events = Event::orderBy('created_at', 'desc')->take(2)->get();
        return view('user.home.index', compact('blogs', 'vegetables', 'events'));
    }
}