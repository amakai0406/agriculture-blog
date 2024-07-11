<?php


use App\Http\Controllers\admin\AuthController;

use App\Http\Controllers\Admin\AdminController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;

Route::get('/admin', [DashboardController::class, 'index']);


Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');


Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');
Route::post('/admin/admins/login', [AuthController::class, 'login']);


