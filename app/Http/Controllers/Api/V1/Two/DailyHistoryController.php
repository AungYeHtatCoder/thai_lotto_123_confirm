<?php

namespace App\Http\Controllers\Api\V1\Two;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\TwoDLimit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DailyHistoryController extends Controller
{
    public function TwodDailyEarlyMorningHistory()
{
    $startTime = Carbon::today()->timezone('Asia/Yangon')->setHour(6)->setMinute(0); // Example: today at 2 PM
    $endTime = Carbon::today()->timezone('Asia/Yangon')->setHour(9)->setMinute(30); // Example: today at 4 PM

    // Fetch the two digits within the specified time range
    $twoDigits = DB::table('lottery_two_digit_pivot')
        ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
        ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
        ->where('lottery_two_digit_pivot.currency', 'mmk')
        ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at') // Select the columns you need
        ->get();

    // Calculate the total sum of sub_amount
    $totalSubAmount = $twoDigits->sum('sub_amount');
    $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

    $startTime_baht = Carbon::today()->timezone('Asia/Yangon')->setHour(6)->setMinute(0); // Example: today at 2 PM
    $endTime_baht = Carbon::today()->timezone('Asia/Yangon')->setHour(9)->setMinute(30); // Example: today at 4 PM

    // Fetch the two digits within the specified time range
    $twoDigits_baht = DB::table('lottery_two_digit_pivot')
        ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
        ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime_baht, $endTime_baht])
        ->where('lottery_two_digit_pivot.currency', 'baht') // Add this line
        ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at') // Select the columns you need
        ->get();

    // Calculate the total sum of sub_amount
    $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');
    $twod_limits_baht = TwoDLimit::orderBy('id', 'desc')->first();

    return response()->json([
       'two_digits' => $twoDigits,
        'totalSubAmount' => $totalSubAmount,
        'twod_limits' => $twod_limits,
        'two_digits_baht' => $twoDigits_baht,
        'totalSubAmount_baht' => $totalSubAmount_baht,
        'twod_limits_baht' => $twod_limits_baht,
    ]);
}
}