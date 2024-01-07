<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\WelcomeController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', [App\Http\Controllers\User\WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [HomeController::class, 'profile'])->name('home');

    Route::get('/two_d/twod_history', [HomeController::class, 'index'])->name('twodHistory');


    //profile management
    Route::put('editProfile/{profile}', [ProfileController::class, 'update'])->name('editProfile');
    Route::post('editInfo', [ProfileController::class, 'editInfo'])->name('editInfo');
    Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('changePassword');
    //profile management

    // Wallet Routes
    Route::prefix('wallet')->group(function () {
        Route::get('/', [WelcomeController::class, 'wallet']);
        Route::get('/topUp-bank', [WelcomeController::class, 'topUpBank']);
        Route::get('/topup', [WelcomeController::class, 'topUp']);
        Route::get('/withdraw-bank', [WelcomeController::class, 'withDrawBank']);
        Route::get('/withdraw', [WelcomeController::class, 'withDraw']);
    });

    // Promotion Routes
    Route::prefix('promotion')->group(function () {
        Route::get('/', [WelcomeController::class, 'promo']);
        Route::get('/promoDetail', [WelcomeController::class, 'promoDetail']);
    });

    // Service Route
    Route::get('/service', [WelcomeController::class, 'servicePage']);

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [WelcomeController::class, 'dashboard']);
        Route::get('/winner-list', [WelcomeController::class, 'winnerList']);
        // Route::get('/twod-history', [WelcomeController::class, 'twodHistory']);
        Route::get('/twod-live', [WelcomeController::class, 'twodLive']);
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
