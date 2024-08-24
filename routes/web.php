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

//ログインページ
Route::get('/admin/login', 'App\Http\Controllers\User\AuthController@index')->name('admin.admins.login');

//ログイン機能
Route::post('/admin/login', 'App\Http\Controllers\User\AuthController@login');

//やさい一覧ページ
Route::get('/user/vegetables', 'App\Http\Controllers\User\UserVegetableController@index')->name('user.vegetables.index');

//やさい詳細ページ
Route::get('/user/vegetables/{id}', 'App\Http\Controllers\User\UserVegetableController@show')->name('user.vegetables.show');

//ブログ一覧ページ
Route::get('/user/blogs', 'App\Http\Controllers\User\UserBlogController@index')->name('user.blogs.index');

//ブログ詳細ページ
Route::get('/user/blogs/{id}', 'App\Http\Controllers\User\UserBlogController@show')->name('user.blogs.show');

//農業体験イベント予約入力ページ
Route::get('/user/reservations/create', 'App\Http\Controllers\User\UserReservationController@create')->name('user.reservations.create');

//指定農業体験イベント予約入力ページ
Route::get('/reservations/event/{event_id}', 'App\Http\Controllers\User\UserReservationController@reservationsByEventId')->name('user.reservations.byEventId');

//農業体験イベント予約機能
Route::post('/user/reservations', 'App\Http\Controllers\User\UserReservationController@store')->name('user.reservations.store');

//農業体験イベント予約完了ページ
Route::get('/user/reservations/complete', 'App\Http\Controllers\User\UserReservationController@complete')->name('user.reservations.complete');

//イベント一覧ページ
Route::get('/user/events', 'App\Http\Controllers\User\UserEventController@index')->name('user.events.index');

//イベント詳細ページ
Route::get('/user/events/{id}', 'App\Http\Controllers\User\UserEventController@show')->name('user.events.show');

//ログイン承認後ルート
Route::middleware([Authenticate::class])->group(function () {

    //ダッシュボード
    Route::get('/admin/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard');

    //管理者作成ページ
    Route::get('/admin/create', 'App\Http\Controllers\Admin\AdminController@create')->name('admin.create');

    //管理者登録機能
    Route::post('/admin/admins', 'App\Http\Controllers\Admin\AdminController@store')->name('admin.admins.store');

    //ログアウト機能
    Route::post('admin/logout', 'App\Http\Controllers\Admin\AuthController@logout')->name('admin.admins.logout');

    //農業体験イベント一覧表示
    Route::get('admin/events', 'App\Http\Controllers\Admin\AdminEventController@index')->name('admin.events.index');

    //農業体験イベント作成ページの表示
    Route::get('admin/events/create', 'App\Http\Controllers\Admin\AdminEventController@create')->name('admin.events.create');

    //農業体験イベント登録処理
    Route::post('admin/events', 'App\Http\Controllers\Admin\AdminEventController@store')->name('admin.events.store');

    //農業体験イベント編集
    Route::get('/admin/events/{id}/edit', 'App\Http\Controllers\Admin\AdminEventController@edit')->name('admin.events.edit');

    //農業体験イベント更新
    Route::put('admin/events/{id}', 'App\Http\Controllers\Admin\AdminEventController@update')->name('admin.events.update');

    //農業体験イベント削除
    Route::delete('admin/events/{id}', 'App\Http\Controllers\Admin\AdminEventController@destroy')->name('admin.events.destroy');

    //ブログ作成ページ
    Route::get('/admin/blogs/create', 'App\Http\Controllers\Admin\AdminBlogController@create')->name('admin.blogs.create');

    //ブログ投稿機能
    Route::post('/admin/blogs', 'App\Http\Controllers\Admin\AdminBlogController@store')->name('admin.blogs.store');

    //ブログ一覧ページ
    Route::get('/admin/blogs', 'App\Http\Controllers\Admin\AdminBlogController@index')->name('admin.blogs.index');

    //ブログ編集ページ
    Route::get('/admin/blogs/{id}/edit', 'App\Http\Controllers\Admin\AdminBlogController@edit')->name('admin.blogs.edit');

    //ブログ更新機能
    Route::put('/admin/blogs/{id}', 'App\Http\Controllers\Admin\AdminBlogController@update')->name('admin.blogs.update');

    //ブログ削除機能
    Route::delete('admin/blogs/{id}', 'App\Http\Controllers\Admin\AdminBlogController@destroy')->name('admin.blogs.destroy');

    //やさい一覧ページ
    Route::get('/admin/vegetables', 'App\Http\Controllers\Admin\AdminVegetableController@index')->name('admin.vegetables.index');

    //やさい追加ページ
    Route::get('/admin/vegetables/create', 'App\Http\Controllers\Admin\AdminVegetableController@create')->name('admin.vegetables.create');

    //やさい登録機能
    Route::post('/admin/vegetables', 'App\Http\Controllers\Admin\AdminVegetableController@store')->name('admin.vegetables.store');

    //やさい編集ページ
    Route::get('/admin/vegetables/{id}/edit', 'App\Http\Controllers\Admin\AdminVegetableController@edit')->name('admin.vegetables.edit');

    //やさい更新機能
    Route::put('/admin/vegetables/{id}', 'App\Http\Controllers\Admin\AdminVegetableController@update')->name('admin.vegetables.update');

    //やさい削除機能
    Route::delete('/admin/vegetables/{id}', 'App\Http\Controllers\Admin\AdminVegetableController@destroy')->name('admin.vegetables.destroy');

    //予約一覧ページ
    Route::get('/admin/reservations', 'App\Http\Controllers\Admin\AdminReservationController@index')->name('admin.reservations.index');

    //特定の予約一覧ページ
    Route::get('/admin/reservations/{eventId}', 'App\Http\Controllers\Admin\AdminReservationController@show')->name('admin.reservations.show');

    //予約状況の更新
    Route::put('/admin/reservations/{id}', 'App\Http\Controllers\Admin\AdminReservationController@update')->name('admin.reservations.update');

});