<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\admin\StoreBlogRequest;

class BlogController extends Controller
{

    public function index()
    {
        //blogsテーブルから取得したデータをlatestメソッドでcreated_atの新しい順に1ページ１０件でページングし、$blogsに格納
        $blogs = Blog::latest('created_at')->simplePaginate(10);
        //compactメソッドで$blogsをビューに渡し、admin.blogs.indexビューを返す
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {

        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {

        $validated = $request->validated();

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $path = $image->store('public/images');

            $imageName = basename($path);

            $validated['image'] = $imageName;

            Blog::create($validated);

            return to_route('admin.blogs.index')->with('success', '新しいブログを投稿しました');

        }

    }
}