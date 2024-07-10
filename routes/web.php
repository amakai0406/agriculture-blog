<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/admins', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');