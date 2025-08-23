<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/board', 'App\Http\Controllers\BbsController@index')->name('index');
Route::get('/board/{bb}', 'App\Http\Controllers\BbsController@show')->name('detail');

Route::get('/board/{bb}/edit', 'App\Http\Controllers\HomeController@edit')
    ->name('bb.edit')
    ->middleware('can:update,bb');
Route::patch('/board/edit/{bb}', 'App\Http\Controllers\HomeController@update')
    ->name('bb.update')
    ->middleware('can:update,bb');

Route::get('/home/create', 'App\Http\Controllers\HomeController@create')->name('bb.create');
Route::post('/home', 'App\Http\Controllers\HomeController@store')->name('bb.store');
Route::delete('/board/delete/{bb}', 'App\Http\Controllers\HomeController@destroy')
    ->name('bb.delete')
    ->middleware('can:destroy,bb');
Route::post('/board/{bb}/create', 'App\Http\Controllers\CommentController@store')->name('com.store');

Route::get('/board/{bb}/comment/{bbCom}/edit', 'App\Http\Controllers\CommentController@edit')->name('com.edit');
Route::patch('/board/{bb}/comment/{bbCom}', 'App\Http\Controllers\CommentController@update')->name('com.update');
Route::delete('/board/{bb}/comment/{bbCom}', 'App\Http\Controllers\CommentController@destroy')->name('com.destroy');

Route::get('/email/verify', fn()=>view('auth.verify'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')
    ->middleware(['auth','signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification','App\Http\Controllers\Auth\VerificationController@resend')
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/index', 'App\Http\Controllers\Admin\AdminController@index')
        ->name('admin.index');
    Route::get('/admin/users', 'App\Http\Controllers\Admin\AdminController@users')
        ->name('admin.users');
    Route::get('/admin/bbs', 'App\Http\Controllers\Admin\AdminController@bbs')
        ->name('admin.bbs');
    Route::get('/admin/logs/dawnload', 'App\Http\Controllers\Admin\AdminController@logs')->name('admin.logs');
});

Route::patch('/profile/edit/{user}/avatar', 'App\Http\Controllers\HomeController@UpdateAvatar')->name('profile.update.avatar');
Route::patch('/profile/edit/{user}', 'App\Http\Controllers\HomeController@UpdateProfile')->name('profile.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('home');
