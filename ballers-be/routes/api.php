<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BuyerApiController;
use App\Http\Controllers\Api\SellerApiController;
use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\UploadController;

// Route::post('/upload'. [UploadController::class, 'upload']);
Route::post('/login', [AuthApiController::class, 'login'])->name('login');
Route::post('/register', [AdminApiController::class,  'register'])->name('register');

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthApiController::class, 'profile'])->name('profile');
});

Route::group([
    'middleware' => ['auth:sanctum']
    // 'middleware' => ['auth:sanctum', 'Role:Buyer']
], function () {
    Route::get('/buyerDashboard', [BuyerApiController::class, 'buyerDashboard'])->name('buyerDashboard');
    Route::get('/basketballFieldDetail/{id}', [BuyerApiController::class, 'BasketballFieldDetail'])->name('BasketballFieldDetail');
    Route::get('/basketballFieldUpdate/{id}', [BuyerApiController::class, 'BasketballFieldDetail'])->name('BasketballFieldDetail');
    Route::get('/basketballField/{id}', [SellerApiController::class, 'basketballFieldEdit'])->name('BasketballFieldEdit');

    Route::patch('/basketballFieldUpdate/{id}', [SellerApiController::class, 'basketballFieldUpdate'])->name('BasketballFieldUpdate');
    Route::delete('/deleteBasketBall/{id}', [SellerApiController::class,  'deleteBasketballField'])->name('deleteBasketballField');

    Route::post('/basketballField/paymentPost', [BuyerApiController::class, 'BasketballFieldPaymentPost'])->name('BasketballFieldPaymentPost');
    Route::get('/community', [BuyerApiController::class, 'community'])->name('community');
    Route::post('/communityPost', [BuyerApiController::class, 'communityPost'])->name('communityPost');
    Route::get('/orderHistory', [BuyerApiController::class, 'orderHistory'])->name('orderHistory');
    Route::get('/orderHistory/seller', [BuyerApiController::class, 'SellerOrderHistory'])->name('sellerOrderHistory');
    Route::get('/orderHistoryDetail/{id}', [BuyerApiController::class, 'orderHistoryDetail'])->name('orderHistoryDetail');
});

Route::group([
    'middleware' => ['auth:sanctum']
    // 'middleware' => ['auth:sanctum', 'Role:Seller']
], function () {
    Route::get('/sellerDashboard', [SellerApiController::class, 'sellerDashboard'])->name('sellerDashboard');
    Route::post('/BasketballFieldPost', [SellerApiController::class, 'BasketballFieldPost'])->name('BasketballFieldPost');
});

Route::group([
    'middleware' => ['Role:Admin']
], function () {
    Route::get('/adminDashboard', [AdminApiController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/detailUser/{id}', [AdminApiController::class,  'detailUser'])->name('detailUser');
    Route::patch('/updateUser/{id}', [AdminApiController::class,  'updateUser'])->name('updateUser');
    Route::delete('/deleteUser/{id}', [AdminApiController::class,  'deleteUser'])->name('deleteUser');
});
