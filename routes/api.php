<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V2\NewTwoDController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V2\NewThreeDController;
use App\Http\Controllers\Api\Jackpot\JackpotController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Frontend\HomeController;
use App\Http\Controllers\Api\V1\Frontend\TwoDController;
use App\Http\Controllers\Api\V2\NewJackpotPlayController;
use App\Http\Controllers\Api\V1\Frontend\ThreeDController;
use App\Http\Controllers\Api\V1\Frontend\WalletController;
use App\Http\Controllers\Api\V1\Frontend\PromotionController;
use App\Http\Controllers\Api\Jackpot\JackpotOneWeekGetDataController;





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
    Route::post('/twoD/play', [NewTwoDController::class, 'play']);
    Route::get('/twoD/playHistory', [TwoDController::class, 'playHistory']); //unfinished

    //3D Routes
    Route::get('/threeD', [ThreeDController::class, 'index']);
    Route::post('/threeD/play', [NewThreeDController::class, 'play']);
    Route::get('/threeD/playHistory', [ThreeDController::class, 'playHistory']); //unfinished
    // two once month history
    Route::get('/twoDigitOnceMonthHistory', [TwoDController::class, 'TwoDigitOnceMonthHistory']);
    // three once month history
    Route::get('/threeDigitOnceMonthHistory', [ThreeDController::class, 'OnceMonthThreeDHistory']);
    // jackpot once month history
    Route::get('/jackpotOnceMonthHistory', [JackpotOneWeekGetDataController::class, 'OnceMonthJackpotHistory']);
    // jackpot play
    Route::post('/jackpot-play', [NewJackpotPlayController::class, 'play']);
    // three digit one week play history
    Route::get('/threeDigitOneWeekHistory', [ThreeDController::class, 'OnceWeekThreedigitHistoryConclude']);
    // three digit one month play history
    Route::get('/threeDigitOneMonthHistory', [ThreeDController::class, 'OnceMonthThreedigitHistoryConclude']);

     Route::get('/jackpot-winner-history', [App\Http\Controllers\Admin\Jackpot\JackpotWinnerHistoryController::class, 'getWinnersHistoryForAdminApi'])->name('JackpotHistory');
     // three digit winner history
        Route::get('/three-digit-winner-history', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'getWinnersHistoryForAdminApi'])->name('ThreeDigitHistory');
        // two digit winner history
     Route::get('/two-d-winners-history-group-by-session', [App\Http\Controllers\Admin\TwoDWinnerHistoryController::class, 'getWinnersHistoryForAdminGroupBySessionApi'])->name('winnerHistoryForAdminSession');
     // commission balance update 
    Route::post('/balance-update', [ProfileController::class, 'balanceUpdateApi']);

    // two digit daily history for early morning
    Route::get('/two-digit-daily-early-morning-history', [App\Http\Controllers\Api\V1\Two\DailyHistoryController::class, 'get930Record']);
    // two digit daily history for  morning
    Route::get('/two-digit-daily-12-1-morning-history', [App\Http\Controllers\Api\V1\Two\DailyHistoryController::class, 'get121Record']);
    // two digit daily history for  afternoon
    Route::get('/two-digit-daily-2-pm-afternoon-history', [App\Http\Controllers\Api\V1\Two\DailyHistoryController::class, 'get2Record']);
    // two digit daily history for  evening
    Route::get('/two-digit-daily-4-pm-evening-history', [App\Http\Controllers\Api\V1\Two\DailyHistoryController::class, 'get4pmRecord']);
    // jackpot weekly history
    Route::get('/jackpot-weekly-history-record', [App\Http\Controllers\Api\Jackpot\JackpotController::class, 'WeeklyJackpotHistory']);
    // three digit weekly history
    Route::get('/three-digit-weekly-history-record', [App\Http\Controllers\Api\V1\Frontend\ThreeDController::class, 'WeeklyThreedHistory']);

});