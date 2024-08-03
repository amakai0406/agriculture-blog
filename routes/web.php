<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\AdminBlogController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\Admin\AdminVegetableController;
use App\Http\Controllers\User\UserVegetableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;
use App\Models\Admin;

Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');

//ログインページの表示
Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');
//ログイン処理
Route::post('/admin/admins/login', [AuthController::class, 'login']);

//野菜一覧ページの表示
Route::get('/user/vegetables', [UserVegetableController::class, 'index'])->name('user.vegetables.index');

//野菜の詳細ページの表示
Route::get('/user/vegetables/{id}', [UserVegetableController::class, 'show'])->name('user.vegetables.show');

//ブログ一覧ページの表示
Route::get('/user/blogs', [UserBlogController::class, 'index'])->name('user.blogs.index');

//ブログの詳細ページの表示
Route::get('/user/blogs/{id}', [UserBlogController::class, 'show'])->name('user.blogs.show');

//ログイン承認後ルート
Route::middleware([Authenticate::class])->group(function () {

    //ダッシュボードの表示
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //ログアウト
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.admins.logout');



    //ブログ作成画面の表示
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');

    //ブログの投稿
    Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');

    //ブログ一覧の表示
    Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');

    //ブログ編集
    Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');

    //ブログの更新
    Route::put('/admin/blogs/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');

    //ブログの削除
    Route::delete('admin/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');


    //やさい一覧ページの表示
    Route::get('/admin/vegetables', [AdminVegetableController::class, 'index'])->name('admin.vegetables.index');

    //やさいの追加ページの表示
    Route::get('/admin/vegetables/create', [AdminVegetableController::class, 'create'])->name('admin.vegetables.create');

    //やさいの登録処理
    Route::post('/admin/vegetables', [AdminVegetableController::class, 'store'])->name('admin.vegetables.store');

    //やさいの詳細ページの表示
    Route::get('/admin/vegetables/{id}/edit', [AdminVegetableController::class, 'edit'])->name('admin.vegetables.edit');

    //野菜の野菜の更新
    Route::put('/admin.vegetables/{id}', [AdminVegetableController::class, 'update'])->name('admin.vegetables.update');

    Route::delete('/admin/vegetables/{id}', [AdminVegetableController::class, 'destroy'])->name('admin.vegetables.destroy');

});
