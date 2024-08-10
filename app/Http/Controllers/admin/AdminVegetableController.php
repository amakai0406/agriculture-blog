<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use App\Http\Requests\admin\StoreVegetableRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminVegetableController extends Controller
{

    public function index()
    {
        //ログイン中の管理者情報の取得
        $admin = Auth::guard('admin')->user();
        //vegetableテーブルの全レコードを取得し、$vegetables格納する
        $vegetables = Vegetable::all();

        //vegetablesをcompactメソッドでadmin.vegetables.indexビューに渡し、返す
        return view('admin.vegetables.index', compact('admin', 'vegetables'));
    }

    public function create()
    {
        return view('admin.vegetables.create');
    }

    public function store(StoreVegetableRequest $request)
    {
        //HTTPリクエストをバリデーションして、検証が成功したデータを$validatedに格納する
        $validated = $request->validated();

        //HTTPリクエストにhasFileメソッドでimageファイルがあるか確認し、あった場合
        if ($request->hasFile('image')) {

            //HTTPリクエストのimageファイルを$imageに格納する
            $image = $request->file('image');

            //imageファイルをstoreメソッドでApp\Http\storage\public\imagesに保存し、そのパスを$pathに格納する
            $path = $image->store('public/images');

            //basenameメソッドでパスのファイル名だけを取り出し、$imageNameに格納する
            $imageName = basename($path);

            //ファイル名を検証されたデータ$validatedのimageファイルに格納する
            $validated['image'] = $imageName;
        }

        //検証済みデータを基にcreateメソッドでVegetableインスタンスを作成する
        Vegetable::create($validated);

        //admin.vegetables.createビューへリダイレクトし、新しいやさいを追加しましたとメッセージを表示する
        return redirect()->route('admin.vegetables.create')->with('success', '新しいやさいを追加しました');
    }

    public function edit(int $id)
    {
        //vegetablesテーブルから指定のidと一致すると一致するデータを取得し、$vegetablesに格納
        $vegetable = Vegetable::findOrFail($id);

        //compactメソッドでvegetablesをadmin.vegetables.editビューに渡す
        return view('admin.vegetables.edit', compact('vegetable'));
    }

    public function update(StoreVegetableRequest $request, int $id)
    {
        //リクエストのあったデータを検証し、成功したデータを格納
        $validated = $request->validated();

        //vegetablesテーブルから一致データを取得し、格納
        $vegetable = Vegetable::findOrFail($id);


        //トランザクション開始
        DB::beginTransaction();

        try {
            //それぞれデータベースに保存
            $vegetable->name = $validated['name'];
            $vegetable->description = $validated['description'];

            if ($request->hasFile('image')) {

                //指定慣れたimageをストレージから削除する
                Storage::delete('public/images/' . $vegetable->image);

                //リクエストのあったimageを保存し、パスを格納
                $path = $request->file('image')->store('images', 'public');

                $imageName = basename($path);

                //パスをimageカラムに保存
                $vegetable->image = $imageName;
            }

            //nameとdescriptionを保存
            $vegetable->save();

            //トランザクションをコミット
            DB::commit();

            //指定のページにリダイレクトし、成功メッセージの表示
            return redirect()->route('admin.vegetables.edit', $vegetable->id)->with('success', 'やさいが更新されました');

        } catch (ModelNotFoundException $e) {

            //トランザクションのロールバック
            DB::rollBack();

            //エラーメッセージの作成と表示
            return response()->json(['error' => '指定されたやさいが見つかりませんでした']);
        }

    }

    public function destroy(int $id)
    {
        $vegetable = Vegetable::findOrFail($id);
        $vegetable->delete();

        return redirect()->route('admin.vegetables.index')->with('success', 'やさいが削除されました');
    }

}