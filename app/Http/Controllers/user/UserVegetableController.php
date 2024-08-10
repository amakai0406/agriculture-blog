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
        $vegetable = Vegetable::with('blogs')->findOrFail($id);

        return view('user.vegetables.show', compact('vegetable'));
    }
}