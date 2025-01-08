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

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, 'register_top']);

Route::post('/register', [LoginController::class, 'store']);

Route::get('/mypage/profile/{id?}', [MyPageController::class, 'setting'])->name('setting');

Route::get('/item/{item_id}', [ItemController::class, 'item_detail'])->name('item_detail');

Route::get('/verify/{email}', [LoginController::class, 'verify'])->name('verify');

Route::post('/mypage/set_up', [MyPageController::class, 'set_up']);

Route::get('/mypage/{id}', [MyPageController::class, 'mypage'])->name('mypage');

Route::patch('/mypage/update', [MyPageController::class, 'update']);

Route::get('/sell', [ItemController::class, 'sell_top']);

Route::post('/sell/store', [ItemController::class, 'sell'])->name('sell');