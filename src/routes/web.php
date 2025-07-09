<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;

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

    Route::get('/purchase/{item_id}', [ItemController::class, 'purchase_top'])->name('purchase_top');

});

Route::get('/', [ItemController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'login_top'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, 'register_top']);

Route::post('/verification_email/sent', [LoginController::class, 'store'])->name('store');

Route::get('verification_email/resend/{verification_email}/{password}', [LoginController::class, 'resend'])->name('resend');

Route::get('/verification_email/certification/{email}/{password}', [LoginController::class, 'certification'])->name('certification');

Route::get('/item/{item_id}', [ItemController::class, 'item_detail'])->name('item_detail');

Route::get('/verify/{email}', [LoginController::class, 'verify'])->name('verify');

Route::post('/mypage/image/set_up', [MyPageController::class, 'image_set_up']);

Route::patch('/mypage/image/update', [MyPageController::class, 'image_update']);

Route::patch('/mypage/update', [MyPageController::class, 'update']);

Route::post('/sell/store', [ItemController::class, 'sell'])->name('sell');

Route::get('/nice/{item_id}', [NiceController::class, 'nice'])->name('nice');

Route::post('/item/comment/{item_id}', [MyPageController::class, 'comment'])->name('comment');

Route::get('/purchase/address/{item_id}', [ItemController::class, 'address_change_top'])->name('address_change_top');

Route::post('/shipping_address/{item_id}', [MyPageController::class, 'change_shipping_address'])->name('change_shipping_address');

Route::post('/charge', [PaymentController::class, 'charge']);

Route::get('/transaction_top/{item_id}/{shipping_id}', [TransactionController::class, 'transactionTop'])->name('transaction_top');

Route::get('/transaction/post/{item_id}', [TransactionController::class, 'post'])->name('post');