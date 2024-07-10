<?php

namespace App\Http\Controllers\admin;

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

        $validate = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'error' => '入力内容に誤りがあります。ご確認のうえ、もう一度入力してください。',
        ])->onlyInput('name');
    }
}