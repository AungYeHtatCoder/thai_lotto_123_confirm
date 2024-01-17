<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Frontend\HomeController;
use App\Http\Controllers\Api\V1\Frontend\PromotionController;
use App\Http\Controllers\Api\V1\Frontend\ThreeDController;
use App\Http\Controllers\Api\V1\Frontend\TwoDController;
use App\Http\Controllers\Api\V1\Frontend\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





//publish routes
Route::get('/login', [AuthController::class, 'loginData']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected routes
Route::group(["middleware" => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    
    //profile management
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/changePassword', [ProfileController::class, 'changePassword']);

    //Home Routes
    Route::get('/home', [HomeController::class, 'index']);

    //Wallet Routes
    Route::get('/wallet', [WalletController::class, 'banks']);
    Route::get('/wallet/bank/{id}', [WalletController::class, 'bankDetail']);
    Route::post('/wallet/deposit', [WalletController::class, 'deposit']);
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw']);
    Route::get('/wallet/transferLogs', [WalletController::class, 'transferLog']);

    //Promotion Routes
    Route::get('/promotions', [PromotionController::class, 'promotion']);
    Route::get('/promotion/{id}', [PromotionController::class, 'promotionDetail']);

    //2D Routes
    Route::get('/twoD', [TwoDController::class, 'index']);
    Route::post('/twoD/play', [TwoDController::class, 'play']);
    Route::get('/twoD/playHistory', [TwoDController::class, 'playHistory']);

    //3D Routes
    Route::get('/threeD', [ThreeDController::class, 'index']);
    Route::post('/threeD/play', [ThreeDController::class, 'play']);
});

