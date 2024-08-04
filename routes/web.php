<?php

use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\AdminBlogController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\Admin\AdminVegetableController;
use App\Http\Controllers\User\UserVegetableController;
use App\Http\Controllers\User\UserReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\admin\EventController;



//ログインページ
Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');

//ログイン機能
Route::post('/admin/admins/login', [AuthController::class, 'login']);

//やさい一覧ページ
Route::get('/user/vegetables', [UserVegetableController::class, 'index'])->name('user.vegetables.index');

//やさい詳細ページ
Route::get('/user/vegetables/{id}', [UserVegetableController::class, 'show'])->name('user.vegetables.show');

//ブログ一覧ページ
Route::get('/user/blogs', [UserBlogController::class, 'index'])->name('user.blogs.index');

//ブログ詳細ページ
Route::get('/user/blogs/{id}', [UserBlogController::class, 'show'])->name('user.blogs.show');

//農業体験イベント予約入力ページ
Route::get('/user/reservations/create', [UserReservationController::class, 'create'])->name('user.reservation.create');

//ログイン承認後ルート
Route::middleware([Authenticate::class])->group(function () {

    //ダッシュボード
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //管理者作成ページ
    Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');

    //管理者登録機能
    Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');

    //ログアウト機能
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.admins.logout');


    //ブログ作成ページ
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');

    //ブログ投稿機能
    Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');

    //農業体験イベント一覧表示
    Route::get('admin/events', [EventController::class, 'index'])->name('admin.events.index');

    //農業体験イベント作成ページの表示
    Route::get('admin/events/create', [EventController::class, 'create'])->name('admin.events.create');

    Route::post('admin.events/', [EventController::class, 'store'])->name('admin.events.store');

    //農業体験イベント登録処理
    Route::post('admin/events', [EventController::class, 'store'])->name('admin.events.store');

    //農業体験イベント編集
    Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');

    //農業体験イベント更新
    Route::put('admin/events/{id}', [EventController::class, 'update'])->name('admin.events.update');

    //農業体験イベント削除
    Route::delete('admin/events/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');

    //ブログ一覧ページ
    Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');

    //ブログ編集ページ
    Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');

    //ブログ更新機能
    Route::put('/admin/blogs/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');

    //ブログ削除機能
    Route::delete('admin/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');

    //やさい一覧ページ
    Route::get('/admin/vegetables', [AdminVegetableController::class, 'index'])->name('admin.vegetables.index');

    //やさい追加ページ
    Route::get('/admin/vegetables/create', [AdminVegetableController::class, 'create'])->name('admin.vegetables.create');

    //やさい登録機能
    Route::post('/admin/vegetables', [AdminVegetableController::class, 'store'])->name('admin.vegetables.store');

    //やさい編集ページ
    Route::get('/admin/vegetables/{id}/edit', [AdminVegetableController::class, 'edit'])->name('admin.vegetables.edit');

    //やさい更新機能
    Route::put('/admin/vegetables/{id}', [AdminVegetableController::class, 'update'])->name('admin.vegetables.update');

    //やさい削除機能
    Route::delete('/admin/vegetables/{id}', [AdminVegetableController::class, 'destroy'])->name('admin.vegetables.destroy');

});
