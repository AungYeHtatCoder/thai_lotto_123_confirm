<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\BetLottery;
use App\Models\Admin\Matching;
use App\Models\BetLotteryMatchingCopy;
use App\Models\ThreeDigit\ThreeDigit;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThreeDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = ThreeDigit::all();
        return $this->success('digits', $digits);
    }

    public function play(Request $request)
    {
        $request->validate([
            'digit' => 'required|array',
            'sub_amount' => 'required|array',
            'sub_amount.*' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {
            $user = $this->deductUserBalance($request->total_amount);
            $lottery = $this->createLottery($request->total_amount, Auth::user()->id);
            $this->attachDigitsToLottery($lottery, $request->digit, $request->input('sub_amount'), $request->input('match_time'));

            DB::commit();
            return response()->json(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    private function deductUserBalance($totalAmount)
    {
        $user = Auth::user();
        $user->balance -= $totalAmount;

        if ($user->balance < 0) {
            throw new \Exception('Not enough balance.');
        }

        $user->save();

        return $user;
    }

    private function createLottery($totalAmount, $userId)
    {
        return BetLottery::create([
            'total_amount' => $totalAmount,
            'user_id' => $userId,
            'lottery_match_id' => 2, // This should be dynamically determined or validated
        ]);
    }

    private function attachDigitsToLottery($lottery, $digits, $subAmounts, $matchTimeId)
    {
        foreach ($digits as $key => $digit) {
            $totalBetAmountForDigit = DB::table('bet_lottery_matching_copy')
                ->where('digit_entry', $digit)
                ->sum('sub_amount');

            if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
                throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
            }

            $matchTime = Matching::find($matchTimeId);
            if (!$matchTime) {
                throw new \Exception('Invalid match time.');
            }
            
            $pivot = new BetLotteryMatchingCopy();
            $pivot->matching_id = $matchTimeId;
            $pivot->bet_lottery_id = $lottery->id;
            $pivot->digit_entry = $digit;
            $pivot->sub_amount = $subAmounts[$key];
            $pivot->prize_sent = false;
            $pivot->created_at = Carbon::now();
            $pivot->updated_at = Carbon::now();
            $pivot->save();
            
        }
    }
}
