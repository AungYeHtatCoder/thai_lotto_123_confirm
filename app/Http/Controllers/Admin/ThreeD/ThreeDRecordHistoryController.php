<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\BahtBreak;
use App\Models\ThreeDigit\ThreeWinner;

class ThreeDRecordHistoryController extends Controller
{
   public function index()
    {
            $today = Carbon::now();
            if ($today->day <= 1) {
                $targetDay = 1;
            } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        $lotteries = Lotto::with(['threedDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = ThreeWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.three_d.three_d_history', compact('lotteries', 'prize_no', 'matchTime'));
    }
    
    public function show(string $id)
    {
        $lottery = Lotto::with('threedDigits')->findOrFail($id);
        $prize_no = ThreeWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        $today = Carbon::now();
        if ($today->day <= 1) {
            $targetDay = 1;
        } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        return view('admin.three_d.three_d_history_show', compact('lottery', 'prize_no', 'matchTime'));
    }

    //  public function OnceWeekThreedigitHistoryConclude()
    // {
    //     //$userId = auth()->id(); // Get logged in user's ID
    //     $displayJackpotDigit = User::getAdminthreeDigitsHistory();
    //     $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
    //     $baht_limits = BahtBreak::orderBy('id', 'desc')->first();
    //     return view('admin.three_d.one_week_conclude', [
    //         'displayThreeDigits' => $displayJackpotDigit,
    //         'three_limits' => $three_limits,
    //         'baht_limits' => $baht_limits,
    //     ]);
    // }

    public function OnceWeekThreedigitHistoryConclude()
{
    $today = Carbon::now();
    $startDate = $today->copy()->startOfMonth();
    $endDate = $today->copy()->endOfMonth();

    if ($today->day <= 16) {
        $endDate = $today->copy()->startOfMonth()->addDays(15)->endOfDay();
    } else {
        $startDate = $today->copy()->startOfMonth()->addDays(16)->startOfDay();
    }

    $matchTime = DB::table('threed_match_times')
        ->whereMonth('match_time', '=', $today->month)
        ->whereYear('match_time', '=', $today->year)
        ->whereDay('match_time', '=', $today->day <= 1 ? 1 : 16)
        ->first();

    $prize_no = ThreeWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    $currencyRate = Currency::where('name', 'mmk')->latest()->first()->rate;

    $lotteries = DB::table('lottos')
        ->join('lotto_three_digit_pivot', 'lottos.id', '=', 'lotto_three_digit_pivot.lotto_id')
        ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
        ->join('lottery_matches', 'lottos.lottery_match_id', '=', 'lottery_matches.id')
        ->select(
            'lottos.id as lotto_id',
            'lottos.total_amount',
            'lottos.created_at as lotto_created_at',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.currency',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.created_at as pivot_created_at',
            'three_digits.three_digit',
            'lottery_matches.match_name'
        )
        ->whereBetween('lotto_three_digit_pivot.created_at', [$startDate, $endDate])
        ->orderBy('lotto_three_digit_pivot.created_at', 'desc')
        ->get();
            // Clone the query to get the total sub_amount separately
     //$totalSubAmountQuery = $lotteries->sum('sub_amount');
      $totalSubAmountBaht = $lotteries->reduce(function ($carry, $lottery) use ($currencyRate) {
        if ($lottery->currency == 'mmk') {
            return $carry + ($lottery->sub_amount / $currencyRate);
        } else {
            return $carry + $lottery->sub_amount;
        }
    }, 0);
    return view('admin.three_d.one_week_conclude', compact('lotteries', 'prize_no', 'matchTime', 'currencyRate', 'totalSubAmountBaht'));
}


    public function OnceMonthThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getAdminthreeDigitsOneMonthHistory();
        $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
        return view('admin.three_d.one_month_conclude', [
            'displayThreeDigits' => $displayJackpotDigit,
            'three_limits' => $three_limits,
        ]);
    }

}