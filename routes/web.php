<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;

Route::get('/admin', [DashboardController::class, 'index']);

