<?php


use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;


Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');

//ログインページの表示
Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');
//ログイン処理
Route::post('/admin/admins/login', [AuthController::class, 'login']);

//ログイン承認後ルート
Route::middleware([Authenticate::class])->group(function () {

    //ダッシュボードの表示
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //ログアウト
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.admins.logout');


    //ブログ作成画面の表示
    Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');

    //ブログの投稿
    Route::post('admin/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
});
