<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{

    public function index()
    {
        return view('admin.admins.login');
    }

    public function login(Request $request)
    {
        //HTTPリクエスト設定を'name'.'password'を入力必須とし、
        //条件を通ったリクエストを$validateに格納している
        $validate = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        //adminガードを使用して、adminsテーブルのデータを
        //attemptメソッドで$validateで格納したデータと一致するデータをデータベースに探しにいく
        //一致した場合はsession()->regenerate()でセッションIDの再生成を行い、
        if (Auth::guard('admin')->attempt($validate)) {
            $request->session()->regenerate();

            //admin.dashboardへリダイレクト
            return redirect()->route('admin.dashboard');
        }

        //一致するデータがなかった場合はログイン画面に戻り、
        //エラー内容の表示(nameフォームのところは残す)
        return back()->withErrors([
            'error' => '入力内容に誤りがあります。ご確認のうえ、もう一度入力してください。',
        ])->onlyInput('name');
    }
    public function logout(Request $request)
    {
        //adminガードで、、認証されていた管理者ログアウトさせる
        Auth::guard('admin')->logout();

        //セッションを無効にする(ッションが再利用させない)
        $request->session()->invalidate();

        //トークンの再生成(CSRF防止)
        $request->session()->regenerateToken();

        ///admin/admins/loginへリダイレクト
        return redirect('/admin/admins/login');
    }
}