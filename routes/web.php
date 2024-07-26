<?php


use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\Admin\VegetableController;

use App\Http\Controllers\User\UserVegetableController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;


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


    //ブログ一覧の表示
    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');


    //やさい一覧ページの表示
    Route::get('/admin/vegetables', [VegetableController::class, 'index'])->name('admin.vegetables.index');

    //やさいの追加ページの表示
    Route::get('/admin/vegetables/create', [VegetableController::class, 'create'])->name('admin.vegetables.create');

    //やさいの登録処理
    Route::post('/admin/vegetables', [VegetableController::class, 'store'])->name('admin.vegetables.store');

});
