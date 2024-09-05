<?php

use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\UsersController;
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
//静态页面
Route::get('/', [StaticPagesController::class,'home'])->name('home');
Route::get('/help',[StaticPagesController::class,'help'])->name('help');
Route::get('/about', [StaticPagesController::class,'about'])->name('about');

//用户登录/注册
Route::get('/signup',[UsersController::class,'create'])->middleware('guest')->name('signup');
Route::resource('users', UsersController::class)->middleware('auth')->except(['show', 'create', 'store']);
Route::resource('users', UsersController::class)->only(['show', 'create', 'store','index']);

Route::get('login',[SessionsController::class,'create'])->middleware('guest')->name('login');
Route::post('login',[SessionsController::class,'store'])->middleware('guest')->name('login');
Route::delete('logout',[SessionsController::class,'destroy'])->name('logout');

//微博发布/删除
Route::resource('statuses',StatusesController::class,['only'=>['store','destory']])->middleware('auth');


