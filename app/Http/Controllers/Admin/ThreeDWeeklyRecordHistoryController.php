<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ThreeDWeeklyRecordHistoryController extends Controller
{
    public function WeeklyThreedHistory()
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
        $twoDigits = DB::table('lotto_three_digit_pivot')
            ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
            ->whereBetween('lotto_three_digit_pivot.created_at', [$startTime, $endTime])
            ->where('lotto_three_digit_pivot.currency', 'mmk')
            ->select('three_digits.two_digit', 'lotto_three_digit_pivot.sub_amount', 'lotto_three_digit_pivot.prize_sent', 'lotto_three_digit_pivot.currency', 'lotto_three_digit_pivot.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount = $twoDigits->sum('sub_amount');
        $twod_limits = ThreeDDLimit::orderBy('id', 'desc')->first();

        // Repeat the same for $twoDigits_baht
        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(1);
            $endTime_baht = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(16);
            $endTime_baht = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        $twoDigits_baht = DB::table('lotto_three_digit_pivot')
            ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
            ->whereBetween('lotto_three_digit_pivot.created_at', [$startTime_baht, $endTime_baht])
            ->where('lotto_three_digit_pivot.currency', 'baht')
            ->select('three_digits.two_digit', 'lotto_three_digit_pivot.sub_amount', 'lotto_three_digit_pivot.prize_sent', 'lotto_three_digit_pivot.currency', 'lotto_three_digit_pivot.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');
        $twod_limits_baht = ThreeDDLimit::orderBy('id', 'desc')->first();

        return view('admin.three_d.three_d_weekly_history', [
            'displayTwoDigits' => $twoDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
            'displayTwoDigits_baht' => $twoDigits_baht,
            'totalSubAmount_baht' => $totalSubAmount_baht,
            'twod_limits_baht' => $twod_limits_baht,
        ]);
    }
}