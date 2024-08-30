<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        //adminガードを使用し、checkメソッドを使って現在の管理者承認されているのかを確認し、
        //!なので確認できない場合
        if (!Auth::guard('admin')->check()) {

            //admin.admins.loginへリダイレクト
            return redirect()->route('admin.login');
        }

        //確認できた場合は次のミドルウェやコントローラーへ
        return $next($request);
    }
}