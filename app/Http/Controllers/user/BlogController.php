<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        //blogsテーブルのレコードを全取得し、Blogレコードに関するBLogImageも一緒に取得する
        $blogs = Blog::with('images')->simplePaginate(1);
        return view('user.blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('user.blogs.detail', compact('blog'));

    }
}