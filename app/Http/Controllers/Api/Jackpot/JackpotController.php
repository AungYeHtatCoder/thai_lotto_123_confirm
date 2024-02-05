<?php

namespace App\Http\Controllers\Api\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Models\Jackpot\Jackpot;
use App\Models\Admin\Commission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin\TwoDigit;
use App\Models\Jackpot\JackpotLimit;
use App\Models\User\JackpotTwoDigit;
use Illuminate\Support\Facades\Auth;
use App\Models\User\JackpotTwoDigitCopy;
use App\Models\User\JackpotTwoDigitOver;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class JackpotController extends Controller
{
    use HttpResponses;
    // over limit versioin 
        public function store(Request $request)
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
        $limitAmount = JackpotLimit::latest()->first()->jack_limit;
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

            $lottery = Jackpot::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $user->id 
            ]);

            foreach ($request->amounts as $amountInfo) {
                $num = str_pad($amountInfo['num'], 2, '0', STR_PAD_LEFT);
                $sub_amount = $amountInfo['amount'];
                $three_digit = TwoDigit::where('two_digit', $num)->firstOrFail();
                $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                ->where('two_digit_id', $three_digit->id)
                ->sum('sub_amount');

            if ($totalBetAmountForTwoDigit + $sub_amount <= $limitAmount) {
                $pivot = new JackpotTwoDigit([
                    'jackpot_id' => $lottery->id,
                    'two_digit_id' => $three_digit->id,
                    'sub_amount' => $sub_amount,
                    'prize_sent' => false,
                    'currency' => $request->currency,
                ]);
                $pivot->save();
            } else {
                $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                $overLimit = $sub_amount - $withinLimit;

                if ($withinLimit > 0) {
                    $pivotWithin = new JackpotTwoDigit([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $three_digit->id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false,
                        'currency' => $request->currency,
                    ]);
                    $pivotWithin->save();
                }

                if ($overLimit > 0) {
                    $pivotOver = new JackpotTwoDigitOver([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $three_digit->id,
                        'sub_amount' => $overLimit,
                        'prize_sent' => false,
                        'currency' => $request->currency,
                        ]);
                    $pivotOver->save();
                }
            }
                
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
    // limit version
    // public function store(Request $request)
    // {
    //     // Log the entire request
    //     Log::info($request->all());
    //     $break = JackpotLimit::latest()->first()->jack_limit;
    //     // Convert JSON request to an array
    //     $data = $request->json()->all();
    
    //     // Validate the incoming data
    //     $validator = Validator::make($data, [
    //         'currency' => 'required|string|in:baht,bath,mmk',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'amounts' => 'required|array',
    //         'amounts.*.num' => 'required|integer',
    //         'amounts.*.amount' => 'required|integer|min:1',
    //         // 'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
    //     ]);
    
    //     // Check for validation errors
    //     if ($validator->fails()) {
    //         return response()->json(['message' => $validator->errors()], 401);
    //     }
    
    //     // Extract validated data
    //     $validatedData = $validator->validated();
    //     // $subAmount = array_sum(array_column($request->amounts, 'amount'));
        
    //     // if ($subAmount > $break) {
    //     //     return response()->json(['message' => 'Limit ပမာဏထက်ကျော်ထိုးလို့ မရပါ။'], 401);
    //     // }
    //     // Start database transaction
    //     DB::beginTransaction();
    
    //     try {
    //         $totalAmount = $request->totalAmount;
            
    //         $user = Auth::user();
    //         $user->balance -= $totalAmount;
    
    //         // Check if the user has sufficient balance
    //         if ($user->balance < 0) {
    //             return response()->json(['message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
    //         }
    //         /** @var \App\Models\User $user */
    //         $user->save();
    
    //         // Create a new lottery entry
    //         $lottery = Jackpot::create([
    //             'pay_amount' => $totalAmount,
    //             'total_amount' => $totalAmount,
    //             'user_id' => $user->id // Use authenticated user's ID
                
    //         ]);
            
    //         $overLimitAmounts = [];
    //         // Iterate through each bet and process it
    //         foreach ($validatedData['amounts'] as $bet) {
    //             $two_digit_id = $bet['num'] === 0 ? 100 : $bet['num']; // Assuming '00' corresponds to 100
    //             $break = JackpotLimit::latest()->first()->jack_limit;
    //             $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
    //             ->where('two_digit_id', $two_digit_id)
    //             ->sum('sub_amount');
    //             $sub_amount = $bet['amount'];
    //             $check_limit = $totalBetAmountForTwoDigit + $sub_amount;

    //             if($totalBetAmountForTwoDigit + $sub_amount <= $break){
    //                 $pivot = new JackpotTwoDigit([
    //                     'jackpot_id' => $lottery->id,
    //                     'two_digit_id' => $two_digit_id,
    //                     'sub_amount' => $sub_amount,
    //                     'prize_sent' => false,
    //                     'currency' => $request->currency,
    //                 ]);
    //                 $pivot->save();
    //             }else{
    //                 $withinLimit = $break - $totalBetAmountForTwoDigit;
    //                 $overLimit = $sub_amount - $withinLimit;

    //                 if ($withinLimit > 0) {
    //                     $pivotWithin = new JackpotTwoDigit([
    //                         'jackpot_id' => $lottery->id,
    //                         'two_digit_id' => $two_digit_id,
    //                         'sub_amount' => $withinLimit,
    //                         'prize_sent' => false,
    //                         'currency' => $request->currency,
    //                     ]);
    //                     $pivotWithin->save();
    //                       $overLimitAmounts[] = [
    //                         'num' => $bet['num'],
    //                         'amount' => $overLimit,
    //                     ];
    //                 }
    //             }
                
    //         }

    //         if(!empty($overLimitAmounts)){
    //                 return response()->json([
    //                     'overLimitAmounts' => $overLimitAmounts,
    //                     'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'
    //                 ], 401);
    //             }
    
    //         // Commit the transaction
    //         DB::commit();
    
    //         // Return a success response
    //         return $this->success([
    //             'message' => 'Bet placed successfully',
    //         ]);
    //         // return response()->json(['message' => 'Bet placed successfully'], 200);
    //     } catch (\Exception $e) {
    //         // Roll back the transaction in case of error
    //         DB::rollback();
    //         Log::error('Error in play method: ' . $e->getMessage());
    
    //         // Return an error response
    //         return response()->json(['message' => $e->getMessage()], 401);
    //     }
    // }
    // public function store(Request $request)
    // {
    //     // Log the entire request
    //     //Log::info($request->all());
    //     $limitAmount = JackpotLimit::latest()->first()->jack_limit;
    //     // Convert JSON request to an array
    //     $data = $request->json()->all();
    //     $validator = Validator::make($data, [
    //         //'currency' => 'required|string',
    //         'currency' => 'required|string|in:baht,bath,mmk',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'amounts' => 'required|array',
    //         'amounts.*.num' => 'required|integer',
    //         'amounts.*.amount' => 'required|integer|min:1',
    //     ]);
    //     // Check for validation errors
    //     if ($validator->fails()) {
    //         return response()->json(['message' => $validator->errors()], 401);
    //     }
    //     //$commission_percent = Commission::latest()->first()->commission;
    //     $commission_percent = 0.5;
    //     DB::beginTransaction();

    //     try {
    //         // $rate = Currency::latest()->first()->rate;
    //         // //total_amount
    //         // if($request->currency == 'baht'){
    //         //     $totalAmount = $request->totalAmount * $rate;
    //         // }else{
    //         //     $totalAmount = $request->totalAmount;
    //         // }
    //         // //sub_amount
    //         // if ($request->currency == "baht") {
    //         //     $subAmount = array_sum(array_column($request->amounts, 'amount')) * $rate;
    //         // }else{
    //         //     $subAmount = array_sum(array_column($request->amounts, 'amount'));
    //         // }
    //         $totalAmount = $request->totalAmount;
    //         $subAmount = array_sum(array_column($request->amounts, 'amount'));

            
    //         if ($subAmount > $limitAmount) {
    //             return response()->json(['message' => 'Limit ပမာဏထက်ကျော်ထိုးလို့ မရပါ။'], 401);
    //         }

    //         $user = Auth::user();
    //         $user->balance -= $totalAmount;

    //         if ($user->balance < 0) {
    //             throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
    //         }
    //         /** @var \App\Models\User $user */
    //         $user->save();
    //         // commission calculation
    //         if($totalAmount >= 1000){
    //             $commission = ($totalAmount * $commission_percent) / 100;
    //             $user->commission_balance += $commission;
    //             $user->save();
    //         }
    //         $lottery = Jackpot::create([
    //             'pay_amount' => $totalAmount,
    //             'total_amount' => $totalAmount,
    //             'user_id' => $request->user_id
    //         ]);

    //         foreach ($request->amounts as $amount) {
    //             $two_digit_string = $amount['num'];
    //             $sub_amount = $amount['amount'];

    //             $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

    //             $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
    //                 ->where('two_digit_id', $two_digit_id)
    //                 ->sum('sub_amount');
    //             $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
    //             $overLimit = $sub_amount - $withinLimit;
    //             //currency auto exchange
    //             // if($request->currency == "baht"){
    //             //     $sub_amount = $sub_amount * $rate;
    //             // }
    //             $sub_amount = $sub_amount;

    //             if ($totalBetAmountForTwoDigit >= 0) {
    //                 $pivot = new JackpotTwoDigit([
                        
    //                     'jackpot_id' => $lottery->id,
    //                     'two_digit_id' => $two_digit_id,
    //                     'sub_amount' => $sub_amount,
    //                     'prize_sent' => false,
    //                     'currency' => $request->currency,
    //                 ]);
    //                 $pivot->save();
    //             } 

    //             if ($overLimit > 0) {
    //                 $pivotOver = new JackpotTwoDigitOver([
    //                     'jackpot_id' => $lottery->id,
    //                     'two_digit_id' => $two_digit_id,
    //                     'sub_amount' => $overLimit,
    //                     'prize_sent' => false,
    //                     'currency' => $request->currency,
    //                 ]);
    //                 $pivotOver->save();
    //             }
    //         }

    //         DB::commit();
    //         return $this->success([
    //             'message' => 'Successfully placed bet.',
    //             'data' => $lottery
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Error in store method: ' . $e->getMessage());

    //         // Return an error response
    //         return response()->json(['message' => $e->getMessage()], 401);
    //     }
    // }
    // public function store(Request $request)
    // {
    //     // Log the entire request
    //     //Log::info($request->all());
    //     $limitAmount = JackpotLimit::latest()->first()->jack_limit;
    //     // Convert JSON request to an array
    //     $data = $request->json()->all();
    //     $validator = Validator::make($data, [
    //         //'currency' => 'required|string',
    //         'currency' => 'required|string|in:baht,bath,mmk',
    //         'totalAmount' => 'required|numeric|min:1',
    //         'amounts' => 'required|array',
    //         'amounts.*.num' => 'required|integer',
    //         'amounts.*.amount' => 'required|integer|min:1',
    //     ]);
    //     // Check for validation errors
    //     if ($validator->fails()) {
    //         return response()->json(['message' => $validator->errors()], 401);
    //     }
    //     //$commission_percent = Commission::latest()->first()->commission;
    //     $commission_percent = 0.5;
    //     DB::beginTransaction();

    //     try {
    //         $rate = Currency::latest()->first()->rate;
    //         //total_amount
    //         if($request->currency == 'baht'){
    //             $totalAmount = $request->totalAmount * $rate;
    //         }else{
    //             $totalAmount = $request->totalAmount;
    //         }
    //         //sub_amount
    //         if ($request->currency == "baht") {
    //             $subAmount = array_sum(array_column($request->amounts, 'amount')) * $rate;
    //         }else{
    //             $subAmount = array_sum(array_column($request->amounts, 'amount'));
    //         }
            
    //         if ($subAmount > $limitAmount) {
    //             return response()->json(['message' => 'Limit ပမာဏထက်ကျော်ထိုးလို့ မရပါ။'], 401);
    //         }

    //         $user = Auth::user();
    //         $user->balance -= $totalAmount;

    //         if ($user->balance < 0) {
    //             throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
    //         }
    //         /** @var \App\Models\User $user */
    //         $user->save();
    //         // commission calculation
    //         if($totalAmount >= 1000){
    //             $commission = ($totalAmount * $commission_percent) / 100;
    //             $user->commission_balance += $commission;
    //             $user->save();
    //         }
    //         $lottery = Jackpot::create([
    //             'pay_amount' => $totalAmount,
    //             'total_amount' => $totalAmount,
    //             'user_id' => $request->user_id
    //         ]);

    //         foreach ($request->amounts as $amount) {
    //             $two_digit_string = $amount['num'];
    //             $sub_amount = $amount['amount'];

    //             $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

    //             $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
    //                 ->where('two_digit_id', $two_digit_id)
    //                 ->sum('sub_amount');
    //             $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
    //             $overLimit = $sub_amount - $withinLimit;
    //             //currency auto exchange
    //             if($request->currency == "baht"){
    //                 $sub_amount = $sub_amount * $rate;
    //             }

    //             if ($totalBetAmountForTwoDigit >= 0) {
    //                 $pivot = new JackpotTwoDigit([
                        
    //                     'jackpot_id' => $lottery->id,
    //                     'two_digit_id' => $two_digit_id,
    //                     'sub_amount' => $sub_amount,
    //                     'prize_sent' => false
    //                 ]);
    //                 $pivot->save();
    //             } 

    //             if ($overLimit > 0) {
    //                 $pivotOver = new JackpotTwoDigitOver([
    //                     'jackpot_id' => $lottery->id,
    //                     'two_digit_id' => $two_digit_id,
    //                     'sub_amount' => $overLimit,
    //                     'prize_sent' => false
    //                 ]);
    //                 $pivotOver->save();
    //             }
    //         }

    //         DB::commit();
    //         return $this->success([
    //             'message' => 'Successfully placed bet.',
    //             'data' => $lottery
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Error in store method: ' . $e->getMessage());

    //         // Return an error response
    //         return response()->json(['message' => $e->getMessage()], 401);
    //     }
    // }

    public function WeeklyJackpotHistory()
    {
        $user_id = Auth::id(); // Get the authenticated user's ID
        $currentDay = Carbon::now()->day;

        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime = Carbon::now()->startOfMonth()->addDays(1);
            $endTime = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime = Carbon::now()->startOfMonth()->addDays(16);
            $endTime = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        // Fetch the two digits within the specified time range
        $twoDigits = DB::table('jackpot_two_digit')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
            ->where('jackpots.user_id', $user_id)
            ->whereBetween('jackpot_two_digit.created_at', [$startTime, $endTime])
            ->where('jackpot_two_digit.currency', 'mmk')
            ->select('two_digits.two_digit', 'jackpot_two_digit.sub_amount', 'jackpot_two_digit.prize_sent', 'jackpot_two_digit.currency', 'jackpot_two_digit.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount = $twoDigits->sum('sub_amount');
        $twod_limits = JackpotLimit::orderBy('id', 'desc')->first();

        // Repeat the same for $twoDigits_baht
        if ($currentDay >= 2 && $currentDay <= 16) {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(1);
            $endTime_baht = Carbon::now()->startOfMonth()->addDays(15);
        } else {
            $startTime_baht = Carbon::now()->startOfMonth()->addDays(16);
            $endTime_baht = Carbon::now()->addMonth()->startOfMonth()->addDay();
        }

        $twoDigits_baht = DB::table('jackpot_two_digit')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
            ->where('jackpots.user_id', $user_id)
            ->whereBetween('jackpot_two_digit.created_at', [$startTime_baht, $endTime_baht])
            ->where('jackpot_two_digit.currency', 'baht')
            ->select('two_digits.two_digit', 'jackpot_two_digit.sub_amount', 'jackpot_two_digit.prize_sent', 'jackpot_two_digit.currency', 'jackpot_two_digit.created_at')
            ->get();

        // Calculate the total sum of sub_amount
        $totalSubAmount_baht = $twoDigits_baht->sum('sub_amount');
        $twod_limits_baht = JackpotLimit::orderBy('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully',
            'two_digits' => $twoDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
            'two_digits_baht' => $twoDigits_baht,
            'totalSubAmount_baht' => $totalSubAmount_baht,
            'twod_limits_baht' => $twod_limits_baht,
        ]);
    }

    public function OnceMonthJackpotHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthJackpotDigits($userId);
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }

    public function getOneMonthJackpotHistory($startDate, $endDate)
    {
        $startDate = Carbon::createFromFormat('d-M-Y', $startDate);
        $endDate = Carbon::createFromFormat('d-M-Y', $endDate);

        $history = DB::table('jackpot_two_digit')
            ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->join('users', 'jackpots.user_id', '=', 'users.id')
            ->whereBetween('jackpot_two_digit.created_at', [$startDate, $endDate])
            ->select('jackpot_two_digit.*', 'jackpots.pay_amount', 'jackpots.total_amount', 'two_digits.two_digit', 'users.name as user_name')
            ->orderBy('jackpot_two_digit.created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $history
        ]);
    }

    // public function getOneMonthJackpotHistory()
    // {
    //     try {
    //         $oneMonthAgo = Carbon::now()->subMonth();
    //         $userId = Auth::id(); // Get the authenticated user's ID

    //         $history = DB::table('jackpot_two_digit')
    //             ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
    //             ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
    //             ->join('users', 'jackpots.user_id', '=', 'users.id')
    //             ->where('jackpot_two_digit.created_at', '>=', $oneMonthAgo)
    //             ->where('jackpots.user_id', '=', $userId) // Filter by user ID
    //             ->select('jackpot_two_digit.*', 'jackpots.pay_amount', 'jackpots.total_amount', 'two_digits.two_digit', 'users.name as user_name')
    //             ->orderBy('jackpot_two_digit.created_at', 'desc')
    //             ->get();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data retrieved successfully',
    //             'data' => $history
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
}