<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\ThreeDDLimit;
use App\Models\ThreeDigit\LotteryThreeDigitCopy;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;
use App\Models\ThreeDigit\ThreeDigit;
use App\Models\ThreeDigit\ThreeDigitOverLimit;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ThreeDigit\Lotto;

class ThreeDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = ThreeDigit::all();
        $break = ThreeDDLimit::latest()->first()->three_d_limit;
        foreach($digits as $digit)
        {
            $totalAmount = LotteryThreeDigitCopy::where('three_digit_id	', $digit->id)->sum('sub_amount');
            $remaining = $break-$totalAmount;
            $digit->remaining = $remaining;
        }
        return $this->success([
            'digits', $digits,
            'break', $break
        ]);
    }

    public function play(Request $request)
    {
        Log::info($request->all());
        $break = ThreeDDLimit::latest()->first()->three_d_limit;
        $rate = Currency::latest()->first()->rate;

        $request->validate([
            'currency' => 'required|string',
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
        ]);

        if($request->currency == 'baht'){
            $totalAmount = $request->totalAmount * $rate;
        }else{
            $totalAmount = $request->totalAmount;
        }

        $commission_percent = DB::table('commissions')->latest()->first();

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $user->balance -= $totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('Insufficient balance.');
            }

            $user->save();

            // Commission calculation
            if ($totalAmount >= 1000) {
                $commission = ($totalAmount * $commission_percent->commission) / 100;
                $user->commission_balance += $commission;
                $user->save();
            }

            $lottery = Lotto::create([
                'total_amount' => $totalAmount,
                'user_id' => Auth::user()->id,
            ]);

            foreach ($request->amounts as $three_digit_string => $sub_amount) {
                if($request->currency == 'baht'){
                    $sub_amount = $sub_amount['amount'] * $rate;
                }else{
                    $sub_amount = $sub_amount['amount'];
                }

                $three_digit_id = $three_digit_string === '00' ? 1 : intval($three_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_copy')
                    ->where('three_digit_id', $three_digit_id)
                    ->sum('sub_amount');

                $withinLimit = $break - $totalBetAmountForTwoDigit;
                $overLimit = $sub_amount - $withinLimit;

                if ($totalBetAmountForTwoDigit >= 0) {
                    $pivot = new LotteryThreeDigitPivot([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                }

                if ($overLimit > 0) {
                    $pivotOver = new ThreeDigitOverLimit([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit_id,
                        'sub_amount' => $overLimit,
                        'prize_sent' => false
                    ]);
                    $pivotOver->save();
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Successfully placed bet.']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());

            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
