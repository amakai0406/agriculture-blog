<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        //blogsテーブルから取得したデータをlatestメソッドでcreated_atの新しい順に1ページ１０件でページングし、$blogsに格納
        $blogs = Blog::latest('created_at')->with('images')->simplePaginate(10);
        //compactメソッドで$blogsをビューに渡し、admin.blogs.indexビューを返す
        return view('admin.blogs.index', compact('blogs'));
    }
}