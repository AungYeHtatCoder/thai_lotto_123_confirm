<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Admin\Currency;
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

    public function play(Request $request)
{
    Log::info($request->all());
    $break = ThreeDDLimit::latest()->first()->three_d_limit;
    $rate = Currency::latest()->first()->rate;

    $validated = $request->validate([
        'currency' => 'required|string',
        'totalAmount' => 'required|numeric|min:1',
        'amounts' => 'required|array',
        'amounts.*.num' => 'required|integer',
        'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
    ]);

    $totalAmount = $request->currency === 'baht' ? $request->totalAmount * $rate : $request->totalAmount;
    $commission_percent = DB::table('commissions')->latest()->first()->commission ?? 0;

    DB::beginTransaction();

    try {
        $user = Auth::user();
        $user->balance -= $totalAmount;

        if ($user->balance < 0) {
            throw new \Exception('Insufficient balance.');
        }
        /** @var \App\Models\User $user */
        $user->save();

        if ($totalAmount >= 1000) {
            $commission = ($totalAmount * $commission_percent) / 100;
            $user->commission_balance += $commission;
            $user->save();
        }

        $lottery = Lotto::create([
            'total_amount' => $totalAmount,
            'user_id' => $user->id,
        ]);

        foreach ($request->amounts as $item) {
            $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
            $sub_amount = $request->currency === 'baht' ? $item['amount'] * $rate : $item['amount'];
            
            $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
            $three_digit_id = $three_digit->id;

            $totalBetAmount = DB::table('lotto_three_digit_copy')
                               ->where('three_digit_id', $three_digit_id)
                               ->sum('sub_amount');

            $withinLimit = $break - $totalBetAmount;
            $amountToBet = min($sub_amount, $withinLimit);

            if ($amountToBet > 0) {
                LotteryThreeDigitPivot::create([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit_id,
                    'sub_amount' => $amountToBet,
                    'prize_sent' => false
                ]);
            }

            $overLimit = $sub_amount - $amountToBet;
            if ($overLimit > 0) {
                ThreeDigitOverLimit::create([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit_id,
                    'sub_amount' => $overLimit,
                    'prize_sent' => false
                ]);
            }
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Successfully placed bet.']);
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error in play method: ' . $e->getMessage());
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}

//         public function play(Request $request)
// {
//         Log::info($request->all());
//         $break = ThreeDDLimit::latest()->first()->three_d_limit;
//         $rate = Currency::latest()->first()->rate;
//         $request->validate([
//             'currency' => 'required|string',
//             'totalAmount' => 'required|numeric|min:1',
//             'amounts' => 'required|array',
//             'amounts.*.num' => 'required|integer',
//             'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
//         ]);

//         if($request->currency == 'baht'){
//             $totalAmount = $request->totalAmount * $rate;
//         }else{
//             $totalAmount = $request->totalAmount;
//         }

//         $commission_percent = DB::table('commissions')->latest()->first();


//     // Currency conversion rate

//     // Logic to handle different currencies
//     $totalAmount = $request->currency == 'baht' ? $request->totalAmount * $rate : $request->totalAmount;

//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $user->balance -= $totalAmount;
//         if ($user->balance < 0) {
//             throw new \Exception('Insufficient balance.');
//         }
//         /** @var \App\Models\User $user */
//             $user->save();

//             // Commission calculation
//             if ($totalAmount >= 1000) {
//                 $commission = ($totalAmount * $commission_percent->commission) / 100;
//                 $user->commission_balance += $commission;
//                 $user->save();
//             }

//         $lottery = Lotto::create([
//             'total_amount' => $totalAmount,
//             'user_id' => $user->id,
//         ]);

//         foreach ($request->amounts as $amount) {
//             $three_digit_string = str_pad($amount['num'], 3, '0', STR_PAD_LEFT);
//             $threeDigit = ThreeDigit::where('three_digit', $three_digit_string)->firstOrFail();

//             $sub_amount_value = $request->currency == 'baht' ? $amount['amount'] * $rate : $amount['amount'];

//             $lottery->threeDigits()->attach($threeDigit->id, [
//                 'sub_amount' => $sub_amount_value,
//                 'prize_sent' => false,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }

//         DB::commit();
//         return response()->json(['success' => true, 'message' => 'Successfully placed bet.']);
//     } catch (\Exception $e) {
//         DB::rollback();
//         return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
//     }
// }
    // public function play(Request $request)
    // {
    //     Log::info($request->all());
    //     $break = ThreeDDLimit::latest()->first()->three_d_limit;
    //     $rate = Currency::latest()->first()->rate;

    //     $request->validate([
    //         'currency' => 'required|string',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'amounts' => 'required|array',
    //         'amounts.*.num' => 'required|integer',
    //         'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
    //     ]);

    //     if($request->currency == 'baht'){
    //         $totalAmount = $request->totalAmount * $rate;
    //     }else{
    //         $totalAmount = $request->totalAmount;
    //     }

    //     $commission_percent = DB::table('commissions')->latest()->first();

    //     DB::beginTransaction();

    //     try {
    //         $user = Auth::user();
    //         $user->balance -= $totalAmount;

    //         if ($user->balance < 0) {
    //             throw new \Exception('Insufficient balance.');
    //         }

    //         /** @var \App\Models\User $user */
    //         $user->save();

    //         // Commission calculation
    //         if ($totalAmount >= 1000) {
    //             $commission = ($totalAmount * $commission_percent->commission) / 100;
    //             $user->commission_balance += $commission;
    //             $user->save();
    //         }

    //         $lottery = Lotto::create([
    //             'total_amount' => $totalAmount,
    //             'user_id' => Auth::user()->id,
    //         ]);

    //         foreach ($request->amounts as $three_digit_string => $sub_amount) {
    //             if($request->currency == 'baht'){
    //                 $sub_amount = $sub_amount['amount'] * $rate;
    //             }else{
    //                 $sub_amount = $sub_amount['amount'];
    //             }

    //             $three_digit_id = $three_digit_string === '00' ? 1 : intval($three_digit_string, 10) + 1;

    //             $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_copy')
    //                 ->where('three_digit_id', $three_digit_id)
    //                 ->sum('sub_amount');

    //             $withinLimit = $break - $totalBetAmountForTwoDigit;
    //             $overLimit = $sub_amount - $withinLimit;

    //             if ($totalBetAmountForTwoDigit >= 0) {
    //                 $pivot = new LotteryThreeDigitPivot([
    //                     'lotto_id' => $lottery->id,
    //                     'three_digit_id' => $three_digit_id,
    //                     'sub_amount' => $sub_amount,
    //                     'prize_sent' => false
    //                 ]);
    //                 $pivot->save();
    //             }

    //             if ($overLimit > 0) {
    //                 $pivotOver = new ThreeDigitOverLimit([
    //                     'lotto_id' => $lottery->id,
    //                     'three_digit_id' => $three_digit_id,
    //                     'sub_amount' => $overLimit,
    //                     'prize_sent' => false
    //                 ]);
    //                 $pivotOver->save();
    //             }
    //         }

    //         DB::commit();

    //         return response()->json(['success' => true, 'message' => 'Successfully placed bet.']);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Error in store method: ' . $e->getMessage());

    //         return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    //     }
    // }
    // three once week history
     public function OnceWeekThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getAdminthreeDigitsHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
           // 'three_limits' => $three_limits,
        
        ]);
    }

     // three once week history
     public function OnceMonthThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getAdminthreeDigitsOneMonthHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
           // 'three_limits' => $three_limits,
        
        ]);
    }


    // three once month history
    public function OnceMonthThreeDHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthThreeDigits($userId);
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }
}