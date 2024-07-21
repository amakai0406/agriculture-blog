<?php


use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\Admin\EventController;


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

    //農業体験イベント一覧表示
    Route::get('admin/events', [EventController::class, 'index'])->name('admin.events.index');

    //農業体験イベント作成ページの表示
    Route::get('admin/events/create', [EventController::class, 'create'])->name('admin.events.create');

    //農業体験イベント登録処理
    Route::post('admin/events', [EventController::class, 'store'])->name('admin.events.store');

});
