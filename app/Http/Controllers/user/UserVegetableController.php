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
        //$idが数値形式の文字列かどうかの判定
        if (is_numeric($id)) {
            try {

                //findOrFailで指定されたidと一致するレコードをvegetablesテーブルから取得
                $vegetable = Vegetable::findOrFail($id);
                //指定されたレコードが見つからなかった場合
            } catch (ModelNotFoundException $e) {
                //json形式でレスポンスを作成し、404ステータスコードとブログが見つかりませんというメッセージを表示
                return response()->json(['error' => 'ブログが見つかりませんでした'], 404);
            }
        } else {

            //jsonでレスポンスを作成し、400ステータスコードと無効なIDですというメッセージを表示
            return response()->json(['error' => '無効なIDです'], 400);
        }

        //compactメソッドでvegetablesをuser.vegetables.detailビューに渡す
        return view('user.vegetables.detail', compact('vegetable'));
    }
}