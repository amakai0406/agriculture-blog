<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Vegetable;
use App\Models\BlogImage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class AdminBlogController extends Controller
{

    public function index()
    {
        //ログイン中の管理者を商法を取得し格納
        $admin = Auth::guard('admin')->user();
        //blogsテーブルから取得したデータをlatestメソッドでcreated_atの新しい順に1ページ１０件でページングし、$blogsに格納
        $blogs = Blog::latest('created_at')->simplePaginate(10);
        //compactメソッドで$blogsをビューに渡し、admin.blogs.indexビューを返す
        return view('admin.blogs.index', compact('admin', 'blogs'));
    }


    public function create()
    {
        $vegetables = Vegetable::all();

        return view('admin.blogs.create', compact('vegetables'));
    }

    public function store(StoreBlogRequest $request)
    {

        //HttpリクエストデータをStoreBlogRequestで設定したルールに基に検証し、検証が成功したデータを$validatedに格納する
        $validated = $request->validated();

        $adminId = Auth::guard('admin')->id();

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

            $blogImage->location = $validated['location'];

            $blogImage->save();
        }

        //attachメソッドで指定されたIDの野菜をブログ記事に新たに関連付け
        if ($request->has('vegetable_ids')) {
            $vegetableIds = $request->input('vegetable_ids');
            $blog->vegetables()->attach($vegetableIds);
        }

        //admin.blogs.indexにリダイレクトし、登録成功後に新しいブログを投稿しましたとメッセージを表示する
        return to_route('admin.blogs.edit', ['id' => $blog->id])->with('success', '新しいブログを投稿しました');

    }

    public function edit(int $id)
    {
        //指定された$idデータをblogsテーブルから取得し、$blogに格納する(findメソッドはデータがない場合nullを返す)
        $blog = Blog::find($id);

        $vegetables = Vegetable::all();

        //pluck()特定のカラムの値を抽出する　toArray()コレクションオブジェクトを標準的なPHPの配列に変換
        //関連するvegetablesモデルのidを取り出し、idを配列として格納
        $selectedVegetableIds = $blog->vegetables->pluck('id')->toArray();

        //blogのデータをcompactメソッドでadmin.blogs.editビューに渡す
        return view('admin.blogs.edit', compact('blog', 'vegetables', 'selectedVegetableIds'));

    }
    public function update(StoreBlogRequest $request, int $id)
    {
        //HTTPリクエストをバリデーションし、成功したデータを$validatedに格納すし、それぞれ振り分ける
        $validated = $request->validated();

        //トランザクション開始
        DB::beginTransaction();

        try {

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
                //$pathをimage_pathカラムに保存し、リクエストのlocationデータをlocationカラムに保存する
                //それらのデータを元にcreateメソッドで新しいレコードを作成する
                $blog->images()->create([
                    'image_path' => $path,
                    'location' => $request->location,
                ]);

            }

            //titleとcontentをデータベースに保存する
            $blog->save();

            //トランザクションコミット
            DB::commit();

            if ($request->has('vegetable_ids')) {
                //vegetables()ブログ記事と野菜の間のリレーションシップ（多対多の関係）
                //syncメソッド現在関連付けられているレコードを新しいIDリストに置き換える
                $blog->vegetables()->sync($request->input('vegetable_ids'));
            }

            //admin/blogs/{id}/edit指定されたidのページにリダイレクトし、ブログが更新されましたとメッセージを表示する
            return redirect()->route('admin.blogs.edit', $blog->id)->with('success', 'ブログが更新されました');

            //エラー(例外)が発生した場合
        } catch (ModelNotFoundException $e) {

            //トランザクションをロールバックし、元の状態に戻す(変更前)
            DB::rollBack();

            //json形式でレスポンスを作成し、500(内部サーバエラー)ステータスコードとブログの更新中にエラーが発生しましたの表示
            return response()->json(['error' => 'ブログの更新中にエラーが発生しました'], 500);

        }
    }

    public function destroy(int $id)
    {

        //指定されたidのブログを取得し、＄blogに格納する
        $blog = Blog::findOrFail($id);

        //関連データ削除
        $blog->vegetables()->detach();

        //blog_Imagesテーブルのimage_pathを削除する
        $blog->images()->delete();
        //ブログを削除する
        $blog->delete();

        //admin.blogs.indexビューへリダイレクト
        return redirect()->route('admin.blogs.index');

    }

}