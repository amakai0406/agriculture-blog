<?php

use App\Http\Controllers\admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/admins/login', [AuthController::class, 'index'])->name('admin.admins.login');
Route::post('/admin/admins/login', [AuthController::class, 'login']);