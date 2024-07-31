<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserVegetableController extends Controller
{

    public function index()
    {
        //allメソッドでvegetablesテーブルの全レコードを取得し、$vegetablesに格納
        $vegetables = Vegetable::all();
        //compactメソッドで、vegetablesをuser.vegetables.indexビューに渡す
        return view('user.vegetables.index', compact('vegetables'));
    }

    public function show(int $id)
    {
        try {

            //findOrFailで指定されたidと一致するレコードをvegetablesテーブルから取得
            $vegetable = Vegetable::findOrFail($id);
            //指定されたレコードが見つからなかった場合
        } catch (ModelNotFoundException $e) {
            //json形式でレスポンスを作成し、404ステータスコードとやさいが見つかりませんというメッセージを表示
            return response()->json(['error' => 'やさいが見つかりませんでした'], 404);
        }


        //compactメソッドでvegetablesをuser.vegetables.detailビューに渡す
        return view('user.vegetables.detail', compact('vegetable'));
    }
}