<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\PaymentController;

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
Route::get('/mypage/profile/{id?}', [MyPageController::class, 'setting'])->name('setting');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/mypage/{id?}', [MyPageController::class, 'mypage'])->name('mypage');

    Route::get('/sell', [ItemController::class, 'sell_top']);
});

Route::get('/', [ItemController::class, 'index']);

Route::get('/login', [LoginController::class, 'login_top'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, 'register_top']);

Route::post('/register', [LoginController::class, 'store']);

Route::get('/item/{item_id}', [ItemController::class, 'item_detail'])->name('item_detail');

Route::get('/verify/{email}', [LoginController::class, 'verify'])->name('verify');

Route::post('/mypage/set_up', [MyPageController::class, 'set_up']);

Route::patch('/mypage/update', [MyPageController::class, 'update']);

Route::post('/sell/store', [ItemController::class, 'sell'])->name('sell');

Route::get('/nice/{item_id}', [NiceController::class, 'nice'])->name('nice');

Route::get('/{id?}', [MyPageController::class, 'mylist'])->name('mylist');

Route::get('list_none', [MyPageController::class, 'list_none'])->name('list_none');

Route::post('/item/comment/{item_id}', [MyPageController::class, 'comment'])->name('comment');

Route::get('/purchase/{item_id}', [ItemController::class, 'purchase_top'])->name('purchase_top');

Route::get('/purchase/address/{item_id}', [ItemController::class, 'address_change'])->name('address_change_top');

Route::patch('/address/change', [MyPageController::class, 'address_change'])->name('address_change');

Route::post('/charge', [PaymentController::class, 'charge']);