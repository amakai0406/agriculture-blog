<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use App\Http\Requests\admin\StoreBlogRequest;
use Illuminate\Support\Facades\Auth;



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
        //ブログ作成ブログ作成ページを返す
        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {

        //HttpリクエストデータをStoreBlogRequestで設定したルールに基に検証し、検証が成功したデータを$validatedに格納する
        $validated = $request->validated();

        //Httpリクエストデータの中にhasFileメソッドでimageファイルがあるか確認し、確認できた場合
        if ($request->hasFile('image')) {

            //imageファイルを$imageに格納する
            $image = $request->file('image');

            //$imageをstoreメソッドでstorage/app/public/imagesに保存し、そのパスを$pathに格納する
            $path = $image->store('public/images');

            //$pathをbasenameメソッドを使い、パスのファイル名だけを$imageNameに格納する
            $imageName = basename($path);

            //パスのファイル名を検証されたimageファイル$validated['image_name']に格納する
            $validated['image_name'] = $imageName;

            //ログイン中のユーザIDを$validatedのadmin_idに追加する
            $validated['admin_id'] = Auth::user()->id;

            //Blogモデルを使い、検証済みデータの$validatedを基にインスタンスを作成する
            Blog::create($validated);

            //admin.blogs.indexにリダイレクトし、登録成功後に新しいブログを投稿しましたとメッセージを表示する
            return to_route('admin.blogs.index')->with('success', '新しいブログを投稿しました');

        }

    }

}