<?php


use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\Authenticate;


Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');


Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');
Route::post('/admin/admins/login', [AuthController::class, 'login']);


Route::middleware([Authenticate::class])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('admin/admins/logout', [AuthController::class, 'logout'])->name('admin.admins.logout');

});
