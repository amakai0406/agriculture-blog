<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest('created_at')->simplePaginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }
}