<?php

namespace App\Http\Controllers\Api\V1\Two;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\TwoDLimit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DailyHistoryController extends Controller
{
    public function TwodDailyEarlyMorningHistory()
    {
       $records = $this->get930Record(Auth::user()->id);
       return response()->json($records);
    }
    public function get930Record()
    {
        $user_id = Auth::user()->id;
        try {
            $startTime = Carbon::today()->timezone('Asia/Yangon')->setHour(6)->setMinute(0);
            $endTime = Carbon::today()->timezone('Asia/Yangon')->setHour(9)->setMinute(30);

            // Fetch the two digits within the specified time range for 'mmk' currency
            $twoDigits = DB::table('lottery_two_digit_pivot')
                ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
                ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
                ->where('lotteries.user_id', $user_id)
                ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
                ->where('lottery_two_digit_pivot.currency', 'mmk')
                ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at')
                ->get();

            // Calculate the total sum of sub_amount for 'mmk' currency
            $totalSubAmount = $twoDigits->sum('sub_amount');

            // Fetch the two digits within the specified time range for 'baht' currency
            $twoDigits_baht = DB::table('lottery_two_digit_pivot')
                ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
                ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
                ->where('lotteries.user_id', $user_id)
                ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
                ->where('lottery_two_digit_pivot.currency', 'baht')
                ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at')
                ->get();

            // Calculate the total sum of sub_amount for 'baht' currency
            $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');

            return response()->json([
                'success' => true,
                'message' => 'Data fetched successfully',
                'two_digits' => $twoDigits,
                'totalSubAmount' => $totalSubAmount,
                'two_digits_baht' => $twoDigits_baht,
                'totalSubAmount_baht' => $totalSubAmount_baht,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ]);
        }
    }
    //     public function TwodDailyEarlyMorningHistory()
// {
//     $startTime = Carbon::today()->timezone('Asia/Yangon')->setHour(6)->setMinute(0); // Example: today at 2 PM
//     $endTime = Carbon::today()->timezone('Asia/Yangon')->setHour(9)->setMinute(30); // Example: today at 4 PM

//     // Fetch the two digits within the specified time range
//     $twoDigits = DB::table('lottery_two_digit_pivot')
//         ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
//         ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
//         ->where('lottery_two_digit_pivot.currency', 'mmk')
//         ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at') // Select the columns you need
//         ->get();

//     // Calculate the total sum of sub_amount
//     $totalSubAmount = $twoDigits->sum('sub_amount');
//     $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

//     $startTime_baht = Carbon::today()->timezone('Asia/Yangon')->setHour(6)->setMinute(0); // Example: today at 2 PM
//     $endTime_baht = Carbon::today()->timezone('Asia/Yangon')->setHour(9)->setMinute(30); // Example: today at 4 PM

//     // Fetch the two digits within the specified time range
//     $twoDigits_baht = DB::table('lottery_two_digit_pivot')
//         ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
//         ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime_baht, $endTime_baht])
//         ->where('lottery_two_digit_pivot.currency', 'baht') // Add this line
//         ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent', 'lottery_two_digit_pivot.currency', 'lottery_two_digit_pivot.created_at') // Select the columns you need
//         ->get();

//     // Calculate the total sum of sub_amount
//     $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');
//     $twod_limits_baht = TwoDLimit::orderBy('id', 'desc')->first();

//     return response()->json([
//        'two_digits' => $twoDigits,
//         'totalSubAmount' => $totalSubAmount,
//         'twod_limits' => $twod_limits,
//         'two_digits_baht' => $twoDigits_baht,
//         'totalSubAmount_baht' => $totalSubAmount_baht,
//         'twod_limits_baht' => $twod_limits_baht,
//     ]);
// }
}