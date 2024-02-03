<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Admin\Currency;
use App\Models\Admin\Commission;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\ThreeDigit;
use App\Models\ThreeDigit\ThreeDigitOverLimit;
use App\Models\ThreeDigit\LotteryThreeDigitCopy;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;

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
    //  limit version
     public function play(Request $request)
{
    Log::info($request->all());

    $validated = $request->validate([
        'currency' => 'required|string|in:baht,bath,mmk',
        'totalAmount' => 'required|numeric|min:1',
        'amounts' => 'required|array',
        'amounts.*.num' => 'required|integer',
        'amounts.*.amount' => 'required|integer|min:1',
    ]);

    // Convert total amount based on currency
//    $totalAmount = $request->currency === 'baht' ? $request->totalAmount * $rate : $request->totalAmount;
    $totalAmount = $request->totalAmount;

    DB::beginTransaction();

    try {
        $user = Auth::user();
        $user->balance -= $totalAmount;

        if ($user->balance < 0) {
            throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
        }
        /** @var \App\Models\User $user */
        $user->save();

        // Commission calculation
        //$commission_percent = DB::table('commissions')->latest()->first();
        $commission_percent = 0.5;
        if ($commission_percent && $totalAmount >= 1000) {
            $commission = ($totalAmount * $commission_percent) / 100;
            $user->commission_balance += $commission;
            $user->save();
        }

        $lottery = Lotto::create([
            'total_amount' => $totalAmount,
            'user_id' => $user->id,
        ]);

        $overLimitAmounts = [];
        foreach ($request->amounts as $item) {
            $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
            $sub_amount = $item['amount'];
            $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
            $break = ThreeDDLimit::latest()->first()->three_d_limit;
            $totalBetAmount = DB::table('lotto_three_digit_copy')
                               ->where('three_digit_id', $three_digit->id)
                               ->sum('sub_amount');
            if ($totalBetAmount + $sub_amount <= $break) {
                $pivot = new LotteryThreeDigitPivot([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit->id,
                    'sub_amount' => $sub_amount,
                    'prize_sent' => false,
                    'currency' => $request->currency,
                ]);
                $pivot->save();
            } else {
                $withinLimit = $break - $totalBetAmount;
                $overLimit = $sub_amount - $withinLimit;

                if ($withinLimit > 0) {
                    $pivotWithin = new LotteryThreeDigitPivot([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit->id,
                        'sub_amount' => $withinLimit,
                        'prize_sent' => false,
                        'currency' => $request->currency,
                    ]);
                    $pivotWithin->save();
                     $overLimitAmounts[] = [
            'num' => $num,
            'amount' => $overLimit,
        ];
                }
            }
            
        }
        if(!empty($overLimitAmounts)){
                    return response()->json([
                        'overLimitAmounts' => $overLimitAmounts,
                        'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'
                    ], 401);
                }
        
        DB::commit();
        return $this->success([
            'message' => 'Bet placed successfully.'
        ]);
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error in play method: ' . $e->getMessage());
        Log::error($e->getTraceAsString()); // Log the stack trace
        return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
    }
    }
    // over limit version 
//     public function play(Request $request)
// {
//     Log::info($request->all());
//     $rate = Currency::latest()->first()->rate;
//     Log::info('Currency rate: ' . $rate);

//     $validated = $request->validate([
//         'currency' => 'required|string|in:baht,bath,mmk',
//         'totalAmount' => 'required|numeric|min:1',
//         'amounts' => 'required|array',
//         'amounts.*.num' => 'required|integer',
//         'amounts.*.amount' => 'required|integer|min:1',
//     ]);

//     $totalAmount = $request->totalAmount;
//     DB::beginTransaction(); 

//     try {
//         $user = Auth::user();
//         $user->balance -= $totalAmount;

//         if ($user->balance < 0) {
//             throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
//         }
//         /** @var \App\Models\User $user */
//         $user->save();

//         $commission_percent = 0.5;
//         if ($commission_percent && $totalAmount >= 1000) {
//             $commission = ($totalAmount * $commission_percent) / 100;
//             $user->commission_balance += $commission;
//             $user->save();
//         }

//         $lottery = Lotto::create([
//             'total_amount' => $totalAmount,
//             'user_id' => $user->id,
//         ]);

//         foreach ($request->amounts as $amountInfo) {
//             $num = str_pad($amountInfo['num'], 3, '0', STR_PAD_LEFT);
//             $sub_amount = $amountInfo['amount'];
//             $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();

//             LotteryThreeDigitPivot::create([
//                 'lotto_id' => $lottery->id,
//                 'three_digit_id' => $three_digit->id,
//                 'sub_amount' => $sub_amount,
//                 'prize_sent' => false,
//                 'currency' => $request->currency,
//             ]);

//             $break = ThreeDDLimit::latest()->first()->three_d_limit;
//             $totalBetAmount = DB::table('lotto_three_digit_copy')
//                                ->where('three_digit_id', $three_digit->id)
//                                ->sum('sub_amount');
//             $overLimit = $totalBetAmount + $sub_amount - $break;

//             if ($overLimit > 0) {
//                 ThreeDigitOverLimit::create([
//                     'lotto_id' => $lottery->id,
//                     'three_digit_id' => $three_digit->id,
//                     'sub_amount' => $overLimit,
//                     'prize_sent' => false,
//                     'currency' => $request->currency,
//                 ]);
//             }
//         }

//         DB::commit();
//         return $this->success([
//             'message' => 'Bet placed successfully.'
//         ]);
//     } catch (\Exception $e) {
//         DB::rollback();
//         Log::error('Error in store method: ' . $e->getMessage());
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }


    // three once week history
     public function OnceWeekThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getAdminthreeDigitsHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
       return $this->success($displayThreeDDigit);
    }

     // three once week history
     public function OnceMonthThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getAdminthreeDigitsOneMonthHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
       return $this->success($displayThreeDDigit);
    }


    // three once month history
    public function OnceMonthThreeDHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getUserOneMonthThreeDigits($userId);
        return $this->success($displayThreeDDigit);
    }
}