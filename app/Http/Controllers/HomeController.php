<?php

namespace App\Http\Controllers;

use App\Models\Admin\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\LotteryMatch;
use App\Models\Jackpot\Jackpot;
use App\Models\ThreeDigit\Lotto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
            /** @var bool $isAdmin */
             $isAdmin = auth()->user()->hasRole('Admin');
             $rate = Currency::latest()->first()->rate;
            if ($isAdmin) {
            // Daily Total
            $twoDBahtDaily = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereDate('created_at', '=', now()->today())->sum('total_amount');
            $twoDMmkDaily = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereDate('created_at', '=', now()->today())->sum('total_amount');
            $dailyTotal = ($twoDBahtDaily * $rate) + $twoDMmkDaily;

            // Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $twoDMmkWeekly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $twoDBahtWeekly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $weeklyTotal = ($twoDBahtWeekly * $rate) + $twoDMmkWeekly;

            // Monthly Total
            $twoDMmkMonthly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $twoDBahtMonthly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $monthlyTotal = ($twoDBahtMonthly * $rate) + $twoDMmkMonthly;

            // Yearly Total
            $twoDMmkYearly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $twoDBahtYearly = Lottery::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $yearlyTotal = ($twoDBahtYearly * $rate) + $twoDMmkYearly;

            // 3D Daily Total
            $three_d_dailyTotal = Lotto::whereDate('created_at', '=', now()->today())->sum('total_amount');
            $bahtAmount = Lotto::with('user')
                        ->whereHas('user', function ($query) {
                            $query->where('user_currency', 'baht');
                        })
                        ->whereDate('created_at', '=', now()->today())
                        ->sum('total_amount');

            $mmkAmount = Lotto::with('user')
                        ->whereHas('user', function ($query) {
                            $query->where('user_currency', 'mmk');
                        })
                        ->whereDate('created_at', '=', now()->today())
                        ->sum('total_amount');
            $three_d_dailyTotal = ($mmkAmount / $rate) + $bahtAmount;

            // 3D Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $bahtAmountWeek = Lotto::with('user')->whereHas('user', function ($query) {
                            $query->where('user_currency', 'baht');
                        })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $mmkAmountWeek = Lotto::with('user')->whereHas('user', function ($query) {
                            $query->where('user_currency', 'baht');
                        })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $three_d_weeklyTotal = ($mmkAmountWeek / $rate) + $bahtAmountWeek;


            // 3D Monthly Total
            $bahtAmountMonth = Lotto::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $mmkAmountMonth = Lotto::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $three_d_monthlyTotal = ($mmkAmountMonth / $rate) + $bahtAmountMonth;

            // 3D Yearly Total
            $bahtAmountYear = Lotto::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $mmkAmountYear = Lotto::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $three_d_yearlyTotal = ($mmkAmountYear / $rate) + $bahtAmountYear;

            // Jackpot Daily Total
            $jackpotBahtDaily = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');  
            })->whereDate('created_at', '=', now()->today())->sum('total_amount');
            $jackpotMmkDaily = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');  
            })->whereDate('created_at', '=', now()->today())->sum('total_amount');

            $jackpot_dailyTotal = ($jackpotMmkDaily / $rate) + $jackpotBahtDaily;

            // Jackpot Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $jackpotBahtWeekly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');  
            })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $jackpotMmkWeekly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');  
            })->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

            $jackpot_weeklyTotal = ($jackpotMmkWeekly / $rate) + $jackpotBahtWeekly;

            // Jackpot Monthly Total
            $jackpotBahtMonthly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');  
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $jackpotMmkMonthly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'mmk');  
            })->whereMonth('created_at', '=', now()->month)->whereYear('created_at', '=', now()->year)->sum('total_amount');

            $jackpot_monthlyTotal = ($jackpotMmkMonthly / $rate) + $jackpotBahtMonthly;

            // Jackpot Yearly Total
            $jackpotBahtYearly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');  
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $jackpotMmkYearly = Jackpot::with('user')->whereHas('user', function ($query) {
                $query->where('user_currency', 'baht');  
            })->whereYear('created_at', '=', now()->year)->sum('total_amount');
            $jackpot_yearlyTotal = ($jackpotMmkYearly / $rate) + $jackpotBahtYearly;

            $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();
            $three_d_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first();
            $jackpot_matches = LotteryMatch::where('id', 3)->whereNotNull('is_active')->first();

            // Return the totals, you can adjust this part as per your needs
            return view('admin.dashboard', [
                'dailyTotal'   => $dailyTotal,
                'weeklyTotal'  => $weeklyTotal,
                'monthlyTotal' => $monthlyTotal,
                'yearlyTotal'  => $yearlyTotal,
                'three_d_dailyTotal'   => $three_d_dailyTotal,
                'three_d_weeklyTotal'  => $three_d_weeklyTotal,
                'three_d_monthlyTotal' => $three_d_monthlyTotal,
                'three_d_yearlyTotal'  => $three_d_yearlyTotal,
                'jackpot_dailyTotal'   => $jackpot_dailyTotal,
                'jackpot_weeklyTotal'  => $jackpot_weeklyTotal,
                'jackpot_monthlyTotal' => $jackpot_monthlyTotal,
                'jackpot_yearlyTotal'  => $jackpot_yearlyTotal,
                'lottery_matches' => $lottery_matches,
                'three_d_matches' => $three_d_matches,
                'jackpot_matches' => $jackpot_matches,
            ]);
        } else {
            $userId = auth()->id(); // Get logged in user's ID
            $playedearlyMorningTwoDigits = User::getUserEarlyMorningTwoDigits($userId);
            $playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
            $playedEarlyEveningTwoDigits = User::getUserEarlyEveningTwoDigits($userId);
            $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
            $currency = Currency::latest()->first();
            return view('frontend.user-profile', [
                'earlymorningDigits' => $playedearlyMorningTwoDigits,
                'morningDigits' => $playedMorningTwoDigits,
                'earlyeveningDigit' => $playedEarlyEveningTwoDigits,
                'eveningDigits' => $playedEveningTwoDigits,
                'currency' => $currency,
            ]);
        }
    }

    public function UserPlayEveningRecord()
    {
        $userId = auth()->id(); // Get logged in user's ID
        //$playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('frontend.user_play_evening', [
            //'morningDigits' => $playedMorningTwoDigits,
            'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }

    public function profile()
    {
        return view('frontend.user-profile');
    }
}