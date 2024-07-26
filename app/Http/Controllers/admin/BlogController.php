<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use App\Http\Requests\admin\StoreBlogRequest;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;



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

        $blog->title = $validated['title'];

        $blog->content = $validated['content'];

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

    public function edit($id)
    {
        //指定された$idデータをblogsテーブルから取得し、$blogに格納する(findメソッドはデータがない場合nullを返す)
        $blog = Blog::find($id);

        //blogのデータをcompactメソッドでadmin.blogs.editビューに渡す
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(StoreBlogRequest $request, $id)
    {
        //HTTPリクエストをバリデーションし、成功したデータを$validatedに格納すし、それぞれ振り分ける
        $validated = $request->validated();

        //指定された$idデータをblogsテーブルから取得し、$blogに格納する(findメソッドはデータだあるのが前提、ない場合は例外をスローする)
        $blog = Blog::findOrFail($id);

        $blog->title = $validated['title'];

        $blog->content = $validated['content'];

        //もし、リクエストの中にimageファイルがあった場合は
        if ($request->hasFile('image')) {

            //isNotEmptyメソッドでimageファイルが空でなければ
            if ($blog->images->isNotEmpty()) {
                //foreachでループしてimageファイルを一つずつ処理する
                foreach ($blog->images as $image) {
                    //imageファイルのパスを取得し、ストレージから削除する
                    Storage::delete('public/' . $image->image_path);
                    //データベースからimageファイルを削除する
                    $image->delete();
                }

            }

            //リクエストの中にあったimageファイルをstoreメソッドでstorage/app/public/image_pathに保存し、そのパスを$pathに格納する
            $path = $request->file('image')->store('image_path', 'public');
            //image_pathに保存された$pathをcreateメソッドを使っての子新しいレコードをデータベースに保存している
            $blog->images()->create([
                'image_path' => $path,
            ]);

        }

        //titleとcontentをデータベースに保存する
        $blog->save();

        ///admin/blogs/{id}/edit指定されたidのページにリダイレクトし、ブログが更新されましたとメッセージを表示する
        return redirect()->route('admin.blogs.edit', $blog->id)->with('success', 'ブログが更新されました');

    }

    public function destroy($id)
    {

        //指定されたidのブログを取得し、＄blogに格納する
        $blog = Blog::findOrFail($id);
        //blog_Imagesテーブルのimage_pathを削除する
        $blog->images()->delete();
        //ブログを削除する
        $blog->delete();

        //admin.blogs.indexビューへリダイレクト
        return redirect()->route('admin.blogs.index');

    }

}