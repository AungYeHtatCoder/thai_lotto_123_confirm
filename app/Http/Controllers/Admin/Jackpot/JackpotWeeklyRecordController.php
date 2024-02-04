<?php

namespace App\Http\Controllers\Admin\Jackpot;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotLimit;

class JackpotWeeklyRecordController extends Controller
{
    public function WeeklyJackpotHistory()
    {
        $currentDay = Carbon::now()->day;

        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime = Carbon::now()->startOfMonth()->addDays(1); // Start of the month + 1 day (2nd day of the month)
            $endTime = Carbon::now()->startOfMonth()->addDays(15); // Start of the month + 15 days (16th day of the month)
        } else {
            $startTime = Carbon::now()->startOfMonth()->addDays(16); // Start of the month + 16 days (17th day of the month)
            $endTime = Carbon::now()->addMonth()->startOfMonth()->addDay(); // Start of the next month + 1 day (1st day of the next month)
        }

        // Fetch the two digits within the specified time range
        $twoDigits = DB::table('jackpot_two_digit')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->whereBetween('jackpot_two_digit.created_at', [$startTime, $endTime])
            ->where('jackpot_two_digit.currency', 'mmk')
            ->select('two_digits.two_digit', 'jackpot_two_digit.sub_amount', 'jackpot_two_digit.prize_sent', 'jackpot_two_digit.currency', 'jackpot_two_digit.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount = $twoDigits->sum('sub_amount');
        $twod_limits = JackpotLimit::orderBy('id', 'desc')->first();

        // Repeat the same for $twoDigits_baht
        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(1);
            $endTime_baht = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(16);
            $endTime_baht = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        $twoDigits_baht = DB::table('jackpot_two_digit')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->whereBetween('jackpot_two_digit.created_at', [$startTime_baht, $endTime_baht])
            ->where('jackpot_two_digit.currency', 'baht')
            ->select('two_digits.two_digit', 'jackpot_two_digit.sub_amount', 'jackpot_two_digit.prize_sent', 'jackpot_two_digit.currency', 'jackpot_two_digit.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');
        $twod_limits_baht = JackpotLimit::orderBy('id', 'desc')->first();

        return view('admin.two_d.weekly_jackpot_history', [
            'displayTwoDigits' => $twoDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
            'displayTwoDigits_baht' => $twoDigits_baht,
            'totalSubAmount_baht' => $totalSubAmount_baht,
            'twod_limits_baht' => $twod_limits_baht,
        ]);
    }
}