<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPageController;

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

Route::get('/', [ItemController::class, 'index']);

Route::get('/login', [LoginController::class, 'login_top']);

Route::get('/register', [LoginController::class, 'register_top']);

Route::post('/register', [LoginController::class, 'store']);

Route::get('/mypage/profile', [MyPageController::class, 'setting']);