<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use Carbon\Carbon;
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
    //     public function play(Request $request)
    // {
    //     Log::info($request->all());

    //     $validated = $request->validate([
    //         'currency' => 'required|string|in:baht,bath,mmk',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'amounts' => 'required|array',
    //         'amounts.*.num' => 'required|integer',
    //         'amounts.*.amount' => 'required|integer|min:1',
    //     ]);

    //     // Convert total amount based on currency
    // //    $totalAmount = $request->currency === 'baht' ? $request->totalAmount * $rate : $request->totalAmount;
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

    //         // Commission calculation
    //         //$commission_percent = DB::table('commissions')->latest()->first();
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

    //         $overLimitAmounts = [];
    //         foreach ($request->amounts as $item) {
    //             $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
    //             $sub_amount = $item['amount'];
    //             $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
    //             $break = ThreeDDLimit::latest()->first()->three_d_limit;
    //             $totalBetAmount = DB::table('lotto_three_digit_copy')
    //                             ->where('three_digit_id', $three_digit->id)
    //                             ->sum('sub_amount');
    //             if ($totalBetAmount + $sub_amount <= $break) {
    //                 $pivot = new LotteryThreeDigitPivot([
    //                     'lotto_id' => $lottery->id,
    //                     'three_digit_id' => $three_digit->id,
    //                     'sub_amount' => $sub_amount,
    //                     'prize_sent' => false,
    //                     'currency' => $request->currency,
    //                 ]);
    //                 $pivot->save();
    //             } else {
    //                 $withinLimit = $break - $totalBetAmount;
    //                 $overLimit = $sub_amount - $withinLimit;

    //                 if ($withinLimit > 0) {
    //                     $pivotWithin = new LotteryThreeDigitPivot([
    //                         'lotto_id' => $lottery->id,
    //                         'three_digit_id' => $three_digit->id,
    //                         'sub_amount' => $withinLimit,
    //                         'prize_sent' => false,
    //                         'currency' => $request->currency,
    //                     ]);
    //                     $pivotWithin->save();
    //                     $overLimitAmounts[] = [
    //             'num' => $num,
    //             'amount' => $overLimit,
    //         ];
    //                 }
    //             }
                
    //         }
    //         if(!empty($overLimitAmounts)){
    //                     return response()->json([
    //                         'overLimitAmounts' => $overLimitAmounts,
    //                         'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'
    //                     ], 401);
    //                 }
            
    //         DB::commit();
    //         return $this->success([
    //             'message' => 'Bet placed successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Error in play method: ' . $e->getMessage());
    //         Log::error($e->getTraceAsString()); // Log the stack trace
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
    //     }
    //     }
    // over limit version 
        public function play(Request $request)
    {
        Log::info($request->all());
        $rate = Currency::latest()->first()->rate;
        Log::info('Currency rate: ' . $rate);

        $validated = $request->validate([
            'currency' => 'required|string|in:baht,bath,mmk',
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1',
        ]);

        $totalAmount = $request->totalAmount;
        DB::beginTransaction(); 
        $limitAmount = ThreeDDLimit::latest()->first()->three_d_limit;
        try {
            $user = Auth::user();
            $user->balance -= $totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
            }
            /** @var \App\Models\User $user */
            $user->save();

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

            foreach ($request->amounts as $amountInfo) {
                $num = str_pad($amountInfo['num'], 3, '0', STR_PAD_LEFT);
                $sub_amount = $amountInfo['amount'];
                $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
                $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_copy')
                ->where('three_digit_id', $three_digit->id)
                ->sum('sub_amount');

            if ($totalBetAmountForTwoDigit + $sub_amount <= $limitAmount) {
                $pivot = new LotteryThreeDigitPivot([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit->id,
                    'sub_amount' => $sub_amount,
                    'prize_sent' => false
                ]);
                $pivot->save();
            } else {
                $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                $overLimit = $sub_amount - $withinLimit;

                if ($withinLimit > 0) {
                    $pivotWithin = new LotteryThreeDigitPivot([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit->id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivotWithin->save();
                }

                if ($overLimit > 0) {
                    $pivotOver = new ThreeDigitOverLimit([
                        'lottery_id' => $lottery->id,
                        'two_digit_id' => $three_digit->id,
                        'sub_amount' => $overLimit,
                        'prize_sent' => false
                    ]);
                    $pivotOver->save();
                }
            }
                // LotteryThreeDigitPivot::create([
                //     'lotto_id' => $lottery->id,
                //     'three_digit_id' => $three_digit->id,
                //     'sub_amount' => $sub_amount,
                //     'prize_sent' => false,
                //     'currency' => $request->currency,
                // ]);

                // // Get the break limit for three digits
                // $break = ThreeDDLimit::latest()->first()->three_d_limit;
                // $currentTotalBetAmount = DB::table('lotto_three_digit_pivot')
                //                         ->where('three_digit_id', $three_digit->id)
                //                         ->sum('sub_amount');

                // // Calculate the new total including the current bet
                // $newTotalBetAmount = $currentTotalBetAmount + $sub_amount;

                // // Calculate overLimit amount if any
                // $overLimit = $newTotalBetAmount > $break ? $newTotalBetAmount - $break : 0;

                // // Only store the over-limit amount
                // if ($overLimit > 0) {
                //     ThreeDigitOverLimit::create([
                //         'lotto_id' => $lottery->id,
                //         'three_digit_id' => $three_digit->id,
                //         // Store only the over-limit part, not the entire new total
                //         'sub_amount' => $overLimit,
                //         'prize_sent' => false,
                //         'currency' => $request->currency,
                //     ]);
                // }
            }

            DB::commit();
            return $this->success([
                'message' => 'Bet placed successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


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

    public function WeeklyThreedHistory()
    {
        $user_id = Auth::id();
        $currentDay = Carbon::now()->day;

        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime = Carbon::now()->startOfMonth()->addDays(1);
            $endTime = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime = Carbon::now()->startOfMonth()->addDays(16);
            $endTime = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        // Fetch the three digits within the specified time range
        $threeDigits = DB::table('lotto_three_digit_pivot')
            ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->where('lottos.user_id', $user_id)
            ->whereBetween('lotto_three_digit_pivot.created_at', [$startTime, $endTime])
            ->where('lotto_three_digit_pivot.currency', 'mmk')
            ->select('three_digits.three_digit', 'lotto_three_digit_pivot.sub_amount', 'lotto_three_digit_pivot.prize_sent', 'lotto_three_digit_pivot.currency', 'lotto_three_digit_pivot.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount = $threeDigits->sum('sub_amount');
        $twod_limits = ThreeDDLimit::orderBy('id', 'desc')->first();

        // Repeat the same for $threeDigits_baht
        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(1);
            $endTime_baht = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(16);
            $endTime_baht = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        $threeDigits_baht = DB::table('lotto_three_digit_pivot')
            ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->where('lottos.user_id', $user_id)
            ->whereBetween('lotto_three_digit_pivot.created_at', [$startTime_baht, $endTime_baht])
            ->where('lotto_three_digit_pivot.currency', 'baht')
            ->select('three_digits.three_digit', 'lotto_three_digit_pivot.sub_amount', 'lotto_three_digit_pivot.prize_sent', 'lotto_three_digit_pivot.currency', 'lotto_three_digit_pivot.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount_baht = $threeDigits_baht->sum('sub_amount');
        $twod_limits_baht = ThreeDDLimit::orderBy('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully',
            'three_digits' => $threeDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
            'three_digits_baht' => $threeDigits_baht,
            'totalSubAmount_baht' => $totalSubAmount_baht,
            'twod_limits_baht' => $twod_limits_baht,
        ]);
    }
}