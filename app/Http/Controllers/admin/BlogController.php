<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use App\Http\Requests\admin\StoreBlogRequest;
use App\Models\BlogImage;
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

        $adminId = auth()->id();

        //blogsテーブルに新しいレコードを作成(データの振り分け)->保存
        $blog = new Blog();

        $blog->title = $request->title;

        $blog->content = $request->content;

        $blog->admin_id = $adminId;

        $blog->save();

        //Httpリクエストデータの中にhasFileメソッドでimageファイルがあるか確認し、確認できた場合
        if ($request->hasFile('image')) {

            //リクエストの中のimageファイルをstoreメソッドでpublic/imagesディレクトリに保存し、パスを$imagePathに格納する
            $imagePath = $request->file('image')->store('images', 'public');

            //BlogImageテーブルに新しいレコードの作成(データの振り分け)->保存
            $blogImage = new BlogImage();

            $blogImage->blog_id = $blog->id;

            $blogImage->image_path = $imagePath;

            $blogImage->save();

            //admin.blogs.indexにリダイレクトし、登録成功後に新しいブログを投稿しましたとメッセージを表示する
            return to_route('admin.blogs.index')->with('success', '新しいブログを投稿しました');

        }

    }

}