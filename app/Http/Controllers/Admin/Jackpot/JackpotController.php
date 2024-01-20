<?php

namespace App\Http\Controllers\Admin\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jackpot\Jackpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotWinner;
use App\Models\User\JackpotTwoDigitCopy;

class JackpotController extends Controller
{
    // public function OnceWeekJackpotHistory()
    // {
    //     $displayJackpotDigit = User::getAdminJackpotDigits();
    //      $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    //      $prize_no_jackpot = JackpotWinner::whereDate('created_at', Carbon::today())
    //                               ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    //                               ->orderBy('id', 'desc')
    //                               ->first();
    //     return view('admin.jackpot.onec_week_jackpot_history', [
    //         'displayThreeDigits' => $displayJackpotDigit,
    //         'prize_no' => $prize_no,
    //         'prize_no_jackpot' => $prize_no_jackpot,
    //     ]);
    // }
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
        $lotteries = Jackpot::with(['twoDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.once_week_jackpot_history', compact('lotteries', 'prize_no', 'matchTime'));
    }
    
    public function show(string $id)
    {
        $lottery = Jackpot::with('twoDigits')->findOrFail($id);
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
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
        return view('admin.jackpot.jackpot_show', compact('lottery', 'prize_no', 'matchTime'));
    }

    public function JackpotHistoryindex()
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
        $lotteries = Jackpot::with(['twoDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.once_week_jackpot_history', compact('lotteries', 'prize_no', 'matchTime'));
    }
    
    public function JackpotHistoryshow(string $id)
    {
        $lottery = Jackpot::with('twoDigits')->findOrFail($id);
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
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
        return view('admin.jackpot.jackpot_show', compact('lottery', 'prize_no', 'matchTime'));
    }

    public function Jackpotindex()
    {
        
        $three_digits_prize = JackpotWinner::orderBy('id', 'desc')->first();
        return view('admin.jackpot.prize_index', compact('three_digits_prize'));
    }

    public function JackpotReset()
    {
        JackpotTwoDigitCopy::truncate();
        session()->flash('SuccessRequest', 'Successfully အောက်နှစ်လုံး Reset.');
    return redirect()->back()->with('message', 'Data reset successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //$currentSession = date('H') < 12 ? 'morning' : 'evening';  // before 1 pm is morning

        JackpotWinner::create([
            'prize_no' => $request->prize_no,
            //'session' => $currentSession,
        ]);
        session()->flash('SuccessRequest', 'Three Digit Lottery Prize Number Created Successfully');

        return redirect()->back()->with('success', 'Three Digit Lottery Prize Number Created Successfully');
    }


}