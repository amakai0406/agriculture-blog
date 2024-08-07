<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.layouts.index', compact('admin'));
    }
}