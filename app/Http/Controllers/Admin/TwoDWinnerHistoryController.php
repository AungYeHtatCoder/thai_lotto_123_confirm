<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TwoDWinnerHistoryController extends Controller
{
    public function getWinners()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        // $winners = DB::table('lottery_two_digit_pivot')
        //     ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
        //     ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
        //     ->join('users', 'lotteries.user_id', '=', 'users.id') // Join users table
        //     ->join('twod_winers', 'two_digits.two_digit', '=', 'twod_winers.prize_no')
        //     ->whereDate('twod_winers.created_at', '>=', $oneMonthAgo)
        //     ->groupBy('lotteries.user_id', 'twod_winers.session', 'users.name') // Group by user name as well
        //     ->select(
        //         'lotteries.user_id', 
        //         'twod_winers.session', 
        //         'users.name',
        //         'lottery_two_digit_pivot.sub_amount',
        //         'lotteries.total_amount',
        //         DB::raw('lottery_two_digit_pivot.sub_amount * 85 as prize_amount') // Calculate sub_amount * 85
        //     )
        //     ->get();
            $winners = DB::table('lottery_two_digit_pivot')
    ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
    ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
    ->join('users', 'lotteries.user_id', '=', 'users.id')
    ->join('twod_winers', 'two_digits.two_digit', '=', 'twod_winers.prize_no')
    ->whereDate('twod_winers.created_at', '>=', $oneMonthAgo)
    ->groupBy(
        'lotteries.user_id', 
        'twod_winers.session', 
        'users.name',
        'users.profile',
        'lottery_two_digit_pivot.sub_amount', // Add this
        'lotteries.total_amount', // And this
        'twod_winers.prize_no', // And this
        'twod_winers.created_at',  // Add this
    )
    ->select(
        'lotteries.user_id', 
        'twod_winers.session', 
        'users.name',
        'users.profile',
        'lottery_two_digit_pivot.sub_amount',
        'lotteries.total_amount',
         'twod_winers.prize_no', // Add this
        'twod_winers.created_at', // Add this
        DB::raw('lottery_two_digit_pivot.sub_amount * 85 as prize_amount')
    )
    ->get();

        return view('twod_winners_history', compact('winners'));
    }
    // public function getWinners()
    // {
    //     $oneMonthAgo = Carbon::now()->subMonth();

    //     $winners = DB::table('lottery_two_digit_pivot')
    //         ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
    //         ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
    //         ->join('twod_winers', 'two_digits.two_digit', '=', 'twod_winers.prize_no')
    //         ->whereDate('twod_winers.created_at', '>=', $oneMonthAgo)
    //         ->groupBy('lotteries.user_id', 'twod_winers.session')
    //         ->select('lotteries.user_id', 'twod_winers.session')
    //         ->get();

    //     return view('twod_winners_history', compact('winners'));
    // }
    // public function getWinners()
    // {
    //     $oneMonthAgo = Carbon::now()->subMonth();

    //     $winners = DB::table('lottery_two_digit_pivot')
    //         ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
    //         ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
    //         ->join('twod_winers', 'two_digits.two_digit', '=', 'twod_winers.prize_no')
    //         ->whereDate('twod_winers.created_at', '>=', $oneMonthAgo)
    //         ->groupBy('lotteries.user_id')
    //         ->select('lotteries.user_id')
    //         ->get();

    //     return view('twod_winners_history', compact('winners'));
    // }
}