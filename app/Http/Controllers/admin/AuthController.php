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

        if (Auth::guard('admin')->attempt($validate)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'error' => '入力内容に誤りがあります。ご確認のうえ、もう一度入力してください。',
        ])->onlyInput('name');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/admins/login');
    }
}