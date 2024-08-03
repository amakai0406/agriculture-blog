<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class UserBlogController extends Controller
{

    public function index()
    {
        //blogsテーブルのレコードを全取得し、Blogレコードに関する$blogも一緒に取得するし、ページネーションを10ページずつ
        $blogs = Blog::with('images')->simplePaginate(10);

        //compactメソッドでblogsをuser.blogs.indexビューに渡す
        return view('user.blogs.index', compact('blogs'));
    }

    public function show(int $id)
    {
        //findOrFailを使って、プライマリーキーを使って検索し、指定慣れたidと一致するレコードを$blogに格納する
        $blog = Blog::findOrFail($id);

        //compactでblogをuser.blogs.detailビューに渡す
        return view('user.blogs.detail', compact('blog'));
    }
}