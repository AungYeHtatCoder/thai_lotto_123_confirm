<?php

use App\Http\Controllers\Home\CashInRequestController;
use App\Http\Controllers\Home\CashOutRequestController;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Home\PromotionController;
use App\Http\Controllers\Home\WalletController;
use App\Http\Controllers\User\WelcomeController;
use Illuminate\Support\Facades\Route;



//home route
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [ProfileController::class, 'profile'])->name('home');
    //profile management
    Route::put('editProfile/{profile}', [ProfileController::class, 'update'])->name('editProfile');
    Route::post('editInfo', [ProfileController::class, 'editInfo'])->name('editInfo');
    Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('changePassword');
    //profile management

    Route::get('/two_d/twod_history', [HomeController::class, 'index'])->name('twodHistory');

    // Wallet Routes
    Route::prefix('wallet')->group(function () {
        Route::get('/', [WalletController::class, 'wallet'])->name('wallet');
        Route::get('/topUp-bank', [WalletController::class, 'topUpBank'])->name('topupBank');
        Route::get('/topup/{id}', [WalletController::class, 'topUp'])->name('topup');
        Route::post('/cashInRequest', [CashInRequestController::class, 'store'])->name('cashInRequest');

        Route::get('/withdraw-bank', [WalletController::class, 'withDrawBank'])->name('withdrawBank');
        Route::get('/withdraw/{id}', [WalletController::class, 'withDraw'])->name('withdraw');
        Route::post('/cashOutRequest', [CashOutRequestController::class, 'store'])->name('cashOutRequest');
    });

    // Promotion Routes
    Route::prefix('promotion')->group(function () {
        Route::get('/', [PromotionController::class, 'promo'])->name('promotion');
        Route::get('/promoDetail', [PromotionController::class, 'promoDetail'])->name('promotionDetail');
    });

    // Service Route
    Route::get('/service', [WelcomeController::class, 'servicePage']);

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [WelcomeController::class, 'dashboard']);
        Route::get('/winner-list', [WelcomeController::class, 'winnerList']);
        // Route::get('/twod-history', [WelcomeController::class, 'twodHistory']);
        Route::get('/twod-live', [WelcomeController::class, 'twodLive']);
        Route::get('/twod-calendar', [WelcomeController::class, 'twodCalendar']);
        Route::get('/twod-holiday', [WelcomeController::class, 'twodHoliday']);
        Route::get('/twod-winDigitRecord', [WelcomeController::class, 'twodDigitRecord']);
        Route::get('/threed-live', [WelcomeController::class, 'threedLive']);
        Route::get('/user-profile', [WelcomeController::class, 'userProfile']);
    });

    // Threed Routes
    Route::prefix('threed')->group(function () {
        Route::get('/', [WelcomeController::class, 'threeD']);
        Route::get('/under', [WelcomeController::class, 'threedUnder']);
        Route::get('/quick', [WelcomeController::class, 'threedQuick']);
        Route::get('/confirm', [WelcomeController::class, 'threedConfirm']);
        Route::get('/winner', [WelcomeController::class, 'threedWinner']);
        Route::get('/history', [WelcomeController::class, 'threedHistory']);
    });

    // Twod Routes
    Route::prefix('twod')->group(function () {
        Route::get('/', [WelcomeController::class, 'twoD']);
        Route::get('/play', [WelcomeController::class, 'twoDPlay']);
        Route::get('/confirm', [WelcomeController::class, 'twoDConfirm']);
    });
});
