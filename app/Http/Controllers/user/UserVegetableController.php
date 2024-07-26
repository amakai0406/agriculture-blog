<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;


class UserVegetableController extends Controller
{

    public function index()
    {
        $vegetables = Vegetable::all();
        return view('user.vegetables.index', compact('vegetables'));
    }

    public function show()
    {
        //
    }
}