<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminVegetableController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminReservationController;

use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserVegetableController;
use App\Http\Controllers\User\UserReservationController;
use App\Http\Controllers\User\UserEventController;
use App\Http\Controllers\User\UserHomeController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

//ホームページ
Route::get('/', [UserHomeController::class, 'index'])->name('user.home.index');

//ログインページ
Route::get('/admin/login', [AuthController::class, 'index']);

//ログイン機能
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

//やさい一覧ページ
Route::get('/user/vegetables', [UserVegetableController::class, 'index'])->name('user.vegetables.index');

//やさい詳細ページ
Route::get('/user/vegetables/{id}', [UserVegetableController::class, 'show'])->name('user.vegetables.show');

//ブログ一覧ページ
Route::get('/user/blogs', [UserBlogController::class, 'index'])->name('user.blogs.index');

//ブログ詳細ページ
Route::get('/user/blogs/{id}', [UserBlogController::class, 'show'])->name('user.blogs.show');

//農業体験イベント予約入力ページ
Route::get('/user/reservations/create', [UserReservationController::class, 'create'])->name('user.reservations.create');

//指定農業体験イベント予約入力ページ
Route::get('/reservations/event/{event_id}', [UserReservationController::class, 'reservationsByEventId'])->name('user.reservations.byEventId');

//農業体験イベント予約機能
Route::post('/user/reservations', [UserReservationController::class, 'store'])->name('user.reservations.store');

//農業体験イベント予約完了ページ
Route::get('/user/reservations/complete', [UserReservationController::class, 'complete'])->name('user.reservations.complete');

//イベント一覧ページ
Route::get('/user/events', [UserEventController::class, 'index'])->name('user.events.index');

//イベント詳細ページ
Route::get('/user/events/{id}', [UserEventController::class, 'show'])->name('user.events.show');

//ログイン承認後ルート
Route::middleware([Authenticate::class])->group(function () {

    //ダッシュボード
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //管理者作成ページ
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');

    //管理者登録機能
    Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');

    //ログアウト機能
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.admins.logout');

    //農業体験イベント一覧表示
    Route::get('admin/events', [AdminEventController::class, 'index'])->name('admin.events.index');

    //農業体験イベント作成ページの表示
    Route::get('admin/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');

    //農業体験イベント登録処理
    Route::post('admin/events', [AdminEventController::class, 'store'])->name('admin.events.store');

    //農業体験イベント編集
    Route::get('/admin/events/{id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');

    //農業体験イベント更新
    Route::put('admin/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');

    //農業体験イベント削除
    Route::delete('admin/events/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

    //ブログ作成ページ
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');

    //ブログ投稿機能
    Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');

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

    //予約一覧ページ
    Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');

    //特定の予約一覧ページ
    Route::get('/admin/reservations/{eventId}', [AdminReservationController::class, 'show'])->name('admin.reservations.show');

    //予約状況の更新
    Route::put('/admin/reservations/{id}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');

});