<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
Route::post('admin/admins/create', [AdminController::class, 'store'])->name('admin/admins/create');
