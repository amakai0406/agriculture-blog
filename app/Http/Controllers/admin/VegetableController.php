<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use App\Http\Requests\admin\StoreVegetableRequest;

class VegetableController extends Controller
{

    public function index()
    {
        //vegetableテーブルのデータをすべて取得し、$vegetables格納する
        $vegetables = Vegetable::all();

        //vegetablesをcompactメソッドでadmin.vegetables.indexビューに渡し、返す
        return view('admin.vegetables.index', compact('vegetables'));
    }

    public function create()
    {
        //admin.vegetables.createビューを返す
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

        //dmin.vegetables.createビューへリダイレクトし、新しいやさいを追加しましたとメッセージを表示する
        return redirect()->route('admin.vegetables.create')->with('success', '新しいやさいを追加しました');
    }
}