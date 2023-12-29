<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth']], function () {

Route::get('/two-d-play-index', [App\Http\Controllers\User\TwodPlayIndexController::class, 'index'])->name('twod-play-index');
    // 9:00 am index
    Route::get('/two-d-play-index-simple', [App\Http\Controllers\User\AM9\TwoDplay9AMController::class, 'index'])->name('twod-play-index-9am');
    // 9:00 am confirm page
    Route::get('/two-d-play-9-30-early-morning-confirm', [App\Http\Controllers\User\AM9\TwoDplay9AMController::class, 'play_confirm'])->name('twod-play-confirm-9am');
    // store
    Route::post('/two-d-play-index-9am', [App\Http\Controllers\User\AM9\TwoDplay9AMController::class, 'store'])->name('twod-play-index-9am.store');
    // 12:00 pm index
    Route::get('/two-d-play-index-12pm', [App\Http\Controllers\User\PM12\TwodPlay12PMController::class, 'index'])->name('twod-play-index-12pm');
    // 12:00 pm confirm page
    Route::get('/two-d-play-12-1-morning-confirm', [App\Http\Controllers\User\PM12\TwodPlay12PMController::class, 'play_confirm'])->name('twod-play-confirm-12pm');
    // store
    Route::post('/two-d-play-index-12pm', [App\Http\Controllers\User\PM12\TwodPlay12PMController::class, 'store'])->name('twod-play-index-12pm.store');
    // 2:00 pm index
    Route::get('/two-d-play-index-2pm', [App\Http\Controllers\User\PM2\TwodPlay2PMController::class, 'index'])->name('twod-play-index-2pm');
    // 2:00 pm confirm page
    Route::get('/two-d-play-2-early-evening-confirm', [App\Http\Controllers\User\PM2\TwodPlay2PMController::class, 'play_confirm'])->name('twod-play-confirm-2pm');
    // store
    Route::post('/two-d-play-index-2pm', [App\Http\Controllers\User\PM2\TwodPlay2PMController::class, 'store'])->name('twod-play-index-2pm.store');
    // 4:00 pm index
    Route::get('/two-d-play-index-4pm', [App\Http\Controllers\User\PM4\TwodPlay4PMController::class, 'index'])->name('twod-play-index-4pm');
    // 2:00 pm confirm page
    Route::get('/two-d-play-4-30-evening-confirm', [App\Http\Controllers\User\PM4\TwodPlay4PMController::class, 'play_confirm'])->name('twod-play-confirm-4pm');
    // store
    Route::post('/two-d-play-index-4pm', [App\Http\Controllers\User\PM4\TwodPlay4PMController::class, 'store'])->name('twod-play-index-4pm.store');

    // qick play 9:00 am index
    Route::get('/two-d-quick-play-index', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'index'])->name('twod-quick-play-index');
    Route::get('/two-d-play-quick-confirm', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'play_confirm'])->name('twod-play-confirm-quick');
    // store
    Route::post('/twod-play-quick-confirm', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'store'])->name('twod-play-quickly-confirm.store');

    // other route
    Route::get('/two-d-winners-history', [App\Http\Controllers\User\WinnerHistoryController::class, 'winnerHistory'])->name('winnerHistory');
  Route::get('/morning-play-history-record', [App\Http\Controllers\User\UserPlayTwoDHistoryRecordController::class, 'MorningPlayHistoryRecord']);
  Route::get('/evening-play-history-record', [App\Http\Controllers\User\UserPlayTwoDHistoryRecordController::class, 'EveningPlayHistoryRecord']);

  Route::get('/wallet-deposite', [App\Http\Controllers\User\UserWalletController::class, 'index'])->name('deposite-wallet');
  Route::get('/fill-balance', [App\Http\Controllers\User\UserWalletController::class, 'topUpWallet'])->name('topUpWallet');

  Route::get('/kpay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'topUpSubmit'])->name('topUpSubmit');

  Route::get('/cb-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'CBPaytopUpSubmit'])->name('CBPaytopUpSubmit');

  Route::get('/wave-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'WavePaytopUpSubmit'])->name('WavePaytopUpSubmit');

  Route::get('/aya-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'AYAPaytopUpSubmit'])->name('AYAPaytopUpSubmit');

  Route::post('/user-kpay-fill-money', [UserWalletController::class, 'StoreKpayFillMoney'])->name('StoreKpayFillMoney');

  Route::post('/user-cb-pay-fill-money', [UserWalletController::class, 'StoreCBpayFillMoney'])->name('StoreCBpayFillMoney');

  Route::post('/user-wave-pay-fill-money', [UserWalletController::class, 'StoreWavepayFillMoney'])->name('StoreWavepayFillMoney');

  Route::post('/user-aya-pay-fill-money', [UserWalletController::class, 'StoreAYApayFillMoney'])->name('StoreAYApayFillMoney');
  //withdraw
  Route::get('/withdraw-money', [App\Http\Controllers\User\WithDrawController::class, 'GetWithdraw'])->name('money-withdraw');
  Route::get('k-pay-withdraw-money', [WithDrawController::class, 'UserKpayWithdrawMoney'])->name('UserKpayWithdrawMoney');
  Route::post('k-pay-with-draw-money', [WithDrawController::class, 'StoreKpayWithdrawMoney'])->name('StoreKpayWithdrawMoney');

  Route::get('cb-pay-withdraw-money', [WithDrawController::class, 'UserCBPayWithdrawMoney'])->name('UserCBPayWithdrawMoney');
  Route::post('cb-pay-with-draw-money', [WithDrawController::class, 'StoreCBpayWithdrawMoney'])->name('StoreCBpayWithdrawMoney');

  Route::get('wave-pay-withdraw-money', [WithDrawController::class, 'UserWavePayWithdrawMoney'])->name('UserWavePayWithdrawMoney');
  Route::post('wave-pay-with-draw-money', [WithDrawController::class, 'StoreWavepayWithdrawMoney'])->name('StoreWavepayWithdrawMoney');


  Route::get('aya-pay-withdraw-money', [WithDrawController::class, 'UserAYAPayWithdrawMoney'])->name('UserAYAPayWithdrawMoney');
  Route::post('aya-pay-with-draw-money', [WithDrawController::class, 'StoreAYApayWithdrawMoney'])->name('StoreAYApayWithdrawMoney');

  // three d
  Route::get('/get-three-d', [App\Http\Controllers\User\ThreeDPlayingController::class, 'GetThreeDigit'])->name('GetThreeDigit');
  Route::get('/three-d-play', [App\Http\Controllers\User\ThreeDPlayingController::class, 'ThreeDigitPlay'])->name('ThreeDigitPlay');
  Route::get('/three-d-play-confirm', [App\Http\Controllers\User\ThreeDPlayingController::class, 'ThreeDigitPlayConfirm'])->name('ThreeDigitPlayConfirm');
  Route::get('/three-d-play-confirm-api-format', [App\Http\Controllers\User\ThreeDPlayingController::class, 'ThreeDigitPlayConfirmApi'])->name('ThreeDigitPlayConfirmApi');
  // Route::post('/three-d-play-confirm', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlaystore'])->name('ThreeDigitPlaystore');

  Route::post('/three-digit-play-confirm', [App\Http\Controllers\Admin\ThreeDigitPlayController::class, 'ThreeDigitPlaystore'])->name('ThreeDigitPlaystore');
  Route::get('/user-dashboard', [App\Http\Controllers\User\WelcomeController::class, 'user_dashboard']);

  Route::get('/user-dashboard/twod-live', [App\Http\Controllers\User\WelcomeController::class, 'twodLive']);
  Route::get('/user-dashboard/twod-calendar', [App\Http\Controllers\User\WelcomeController::class, 'twodCalendar']);
  Route::get('/user-dashboard/threed-result', [App\Http\Controllers\User\WelcomeController::class, 'threedResult']);

});
