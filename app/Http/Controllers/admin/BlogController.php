<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    public function index()
    {
        return view('admin.blogs.index');
    }
}