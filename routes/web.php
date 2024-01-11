<?php

use App\Http\Controllers\Admin\BankController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;


use App\Http\Controllers\Admin\BannerController;

use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\PlayTwoDController;
use App\Http\Controllers\Admin\TwoDigitController;
use App\Http\Controllers\Admin\PromotionController;

use App\Http\Controllers\Admin\BannerTextController;


use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TwoDWinnerController;
use App\Http\Controllers\Admin\TwoDLotteryController;
use App\Http\Controllers\Admin\TwoDMorningController;
use App\Http\Controllers\Admin\ThreedHistoryController;
use App\Http\Controllers\Admin\ThreedMatchTimeController;
use App\Http\Controllers\Admin\FillBalanceReplyController;
use App\Http\Controllers\Admin\TransferLogController;

use App\Http\Controllers\Home\CashInRequestController;
use App\Http\Controllers\Home\CashOutRequestController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
require __DIR__ . '/auth.php';
require __DIR__ . '/two_d_play.php';
require __DIR__ . '/frontend.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionController::class);
    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    Route::get('/two-d-users', [App\Http\Controllers\Admin\TwoUsersController::class, 'index'])->name('two-d-users-index');
    // details route
    Route::get('/two-d-users/{id}', [App\Http\Controllers\Admin\TwoUsersController::class, 'show'])->name('two-d-users-details');
    //Banners
    Route::resource('banners', BannerController::class);
    Route::resource('text', BannerTextController::class);
    Route::resource('games', GameController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/banks', BankController::class);

    //cash in lists
    Route::get('/cashIn', [CashInRequestController::class, 'index'])->name('cashIn');
    Route::get('/cashIn/{id}', [CashInRequestController::class, 'show'])->name('cashIn.show');
    Route::post('/cashIn/status/{id}', [CashInRequestController::class, 'status'])->name('statusInChange');
    Route::post('/transfer/{id}', [CashInRequestController::class, "transfer"]);
    //cash out lists
    Route::get('/cashOut', [CashOutRequestController::class, 'index'])->name('cashOut');
    Route::get('/cashOut/{id}', [CashOutRequestController::class, 'show'])->name('cashOut.show');
    Route::post('/cashOut/status/{id}', [CashOutRequestController::class, 'status'])->name('statusOutChange');
    Route::post('/withdraw/{id}', [CashOutRequestController::class, "withdraw"]);
    //transfer logs lists
    Route::get('/transferlogs', [TransferLogController::class, 'index'])->name('transferLog');
    
    //Currency
    Route::resource('currency', CurrencyController::class);
    // profile resource rotues
    Route::resource('profiles', ProfileController::class);
    // user profile route get method
    Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
    Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
    Route::get('/get-three-d', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'GetThreeDigit'])->name('GetThreeDigit');
    Route::get('/three-d-play', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlay'])->name('ThreeDigitPlay');
    Route::get('/three-d-play-confirm', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlayConfirm'])->name('ThreeDigitPlayConfirm');
    Route::get('/three-d-play-confirm-api-format', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlayConfirmApi'])->name('ThreeDigitPlayConfirmApi');
    
    Route::post('/three-digit-play-confirm', [App\Http\Controllers\Admin\ThreeDigitPlayController::class, 'ThreeDigitPlaystore'])->name('ThreeDigitPlaystore');

    Route::get('/quick-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickMorningPlayTwoDigit'])->name('QuickMorningPlayTwoDigit');
    Route::get('/quick-odd-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddMorningPlayTwoDigit'])->name('QuickOddMorningPlayTwoDigit');
    Route::get('/quick-even-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenMorningPlayTwoDigit'])->name('QuickEvenMorningPlayTwoDigit');

    Route::get('/quick-odd-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddSameMorningPlayTwoDigit'])->name('QuickOddSameMorningPlayTwoDigit');

    Route::get('/quick-even-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenSameMorningPlayTwoDigit'])->name('QuickEvenSameMorningPlayTwoDigit');
    Route::post('/quick-two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'Quickstore'])->name('Quickstore');

    Route::get('/two-d-play-noti', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'index'])->name('two-d-play-noti');
    Route::post('/two-d-play-noti-mark-as-read', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'playTwoDmarkNotification'])->name('playTwoDmarkNotification');

    Route::get('/get-two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'index'])->name('SessionResetIndex');
    Route::post('/two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'SessionReset'])->name('SessionReset');
    Route::get('/close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'index'])->name('CloseTwoD');
    Route::put('/update-open-close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'update'])->name('OpenCloseTwoD');
    Route::resource('twod-records', TwoDLotteryController::class);
    Route::resource('tow-d-win-number', TwoDWinnerController::class);
    Route::resource('tow-d-morning-number', TwoDMorningController::class);
    // two d get early morning number
    Route::get('/get-two-d-early-morning-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'GetDigitEarlMorningindex'])->name('earlymorningNumber');
    Route::get('/get-two-d-early-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'GetDigitEarlyEveningindex'])->name('earlyeveningNumber');
    // early morning winner
    Route::get('/two-d-early-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDEarlyMorningWinner'])->name('earlymorningWinner');
    Route::get('/two-d-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDMorningWinner'])->name('morningWinner');
    Route::get('/two-d-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'EveningTwoD'])->name('eveningNumber');

    Route::get('/two-d-early-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEarlyEveningWinner'])->name('earlyeveningWinner');

    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDEveningWinnerController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('profile/fill_money', [ProfileController::class, 'fillmoney']);
    // kpay fill money get route
    Route::get('profile/kpay_fill_money', [ProfileController::class, 'index'])->name('kpay_fill_money');
    Route::resource('fill-balance-replies', FillBalanceReplyController::class);
    Route::get('/daily-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmounts'])->name('dailyIncomeJson');
    Route::get('/with-draw-view', [App\Http\Controllers\Admin\WithDrawViewController::class, 'index'])->name('withdrawViewGet');
    Route::get('/with-draw-details/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'show'])->name('withdrawViewDetails');
    // withdraw update route
    Route::put('/with-draw-update/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'update'])->name('withdrawViewUpdate');
    Route::get('/daily-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsDaily'])->name('getTotalAmountsDaily');
    // week name route
    Route::get('/weekly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsWeekly'])->name('getTotalAmountsWeekly');
    // month name route
    Route::get('/month-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsMonthly'])->name('getTotalAmountsMonthly');
    // year name route
    Route::get('/yearly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsYearly'])->name('getTotalAmountsYearly');
    Route::get('/two-d-users', [App\Http\Controllers\Admin\TwoUsersController::class, 'index'])->name('two-d-users-index');
    // details route
    Route::get('/two-d-users/{id}', [App\Http\Controllers\Admin\TwoUsersController::class, 'show'])->name('two-d-users-details');
    //Banners
    Route::resource('banners', BannerController::class);
    // profile resource rotues
    Route::resource('profiles', ProfileController::class);
    // user profile route get method
    Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
    Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
    Route::resource('play-twod', PlayTwoDController::class);
    Route::get('/get-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'GetTwoDigit'])->name('GetTwoDigit');
    Route::post('lotteries-two-d-play', [TwoDigitController::class, 'store'])->name('StorePlayTwoD');
    Route::get('/morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'MorningPlayTwoDigit'])->name('MorningPlayTwoDigit');

    Route::get('/evening-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'EveningPlayTwoDigit'])->name('EveningPlayTwoDigit');

    Route::post('lotteries-two-d-play', [TwoDigitController::class, 'store'])->name('StorePlayTwoD');
   
    Route::post('/two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'store'])->name('two-d-play.store');
    Route::get('/quick-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickMorningPlayTwoDigit'])->name('QuickMorningPlayTwoDigit');
    Route::get('/quick-odd-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddMorningPlayTwoDigit'])->name('QuickOddMorningPlayTwoDigit');
    Route::get('/quick-even-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenMorningPlayTwoDigit'])->name('QuickEvenMorningPlayTwoDigit');

    Route::get('/quick-odd-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddSameMorningPlayTwoDigit'])->name('QuickOddSameMorningPlayTwoDigit');

    Route::get('/quick-even-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenSameMorningPlayTwoDigit'])->name('QuickEvenSameMorningPlayTwoDigit');
    Route::post('/quick-two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'Quickstore'])->name('Quickstore');
    Route::get('/two-d-play-noti', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'index'])->name('two-d-play-noti');
    Route::post('/two-d-play-noti-mark-as-read', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'playTwoDmarkNotification'])->name('playTwoDmarkNotification');

    Route::get('/get-two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'index'])->name('SessionResetIndex');
    Route::post('/two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'SessionReset'])->name('SessionReset');
    Route::get('/close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'index'])->name('CloseTwoD');
    Route::put('/update-open-close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'update'])->name('OpenCloseTwoD');
    Route::resource('twod-records', TwoDLotteryController::class);
    Route::resource('tow-d-win-number', TwoDWinnerController::class);
    Route::resource('tow-d-morning-number', TwoDMorningController::class);
    Route::get('/two-d-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDMorningWinner'])->name('morningWinner');
    Route::get('/two-d-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'EveningTwoD'])->name('eveningNumber');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDEveningWinnerController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('profile/fill_money', [ProfileController::class, 'fillmoney']);
    // kpay fill money get route
    Route::get('profile/kpay_fill_money', [ProfileController::class, 'index'])->name('kpay_fill_money');
    Route::resource('fill-balance-replies', FillBalanceReplyController::class);
    Route::get('/daily-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmounts'])->name('dailyIncomeJson');
    Route::get('/with-draw-view', [App\Http\Controllers\Admin\WithDrawViewController::class, 'index'])->name('withdrawViewGet');
    Route::get('/with-draw-details/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'show'])->name('withdrawViewDetails');
    // withdraw update route
    Route::put('/with-draw-update/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'update'])->name('withdrawViewUpdate');
    Route::get('/daily-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsDaily'])->name('getTotalAmountsDaily');
    // week name route
    Route::get('/weekly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsWeekly'])->name('getTotalAmountsWeekly');
    // month name route
    Route::get('/month-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsMonthly'])->name('getTotalAmountsMonthly');
    // year name route
    Route::get('/yearly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsYearly'])->name('getTotalAmountsYearly');

    // 3d lottery routes
    Route::get('/threed-lotteries-history', [ThreedHistoryController::class, 'index']);
    Route::get('/threed-lotteries-match-time', [ThreedMatchTimeController::class, 'index']);
    // 3d prize number create
    Route::get('/three-d-prize-number-create', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'index'])->name('three-d-prize-number-create');
    Route::post('/three-d-prize-number-create', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'store'])->name('three-d-prize-number-create.store');
    // 3d history
    Route::get('/three-d-history', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'index'])->name('three-d-history');
    // 3d history show
    Route::get('/three-d-history-show/{id}', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'show'])->name('three-d-history-show');
    // three d list index
    Route::get('/three-d-list-index', [App\Http\Controllers\Admin\ThreeD\ThreeDListController::class, 'index'])->name('three-d-list-index');
    // three d list show
    Route::get('/three-d-list-show/{id}', [App\Http\Controllers\Admin\ThreeD\ThreeDListController::class, 'show'])->name('three-d-list-show');
    // 3d winner list
    Route::get('/three-d-winner', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'index'])->name('three-d-winner');
    Route::post('/two-d-session-over-amount-limit-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'OverAmountLimitSessionReset'])->name('OverAmountLimitSessionReset');
        // three d reset
        Route::post('/three-d-reset', [App\Http\Controllers\Admin\ThreeD\ThreeDResetController::class, 'ThreeDReset'])->name('ThreeDReset');


});