<?php

namespace App\Http\Controllers\Api\Jackpot;

use App\Models\User;
use App\Models\Jackpot\Jackpot;
use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Models\Admin\Commission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotLimit;
use App\Models\User\JackpotTwoDigit;
use Illuminate\Support\Facades\Auth;
use App\Models\User\JackpotTwoDigitCopy;
use App\Models\User\JackpotTwoDigitOver;
use Illuminate\Support\Facades\Validator;

class JackpotController extends Controller
{
    public function store(Request $request)
    {
        // Log the entire request
        Log::info($request->all());
        $limitAmount = JackpotLimit::latest()->first()->jack_limit;
        // Convert JSON request to an array
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'currency' => 'required|string',
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1|max:'.$limitAmount,
        ]);
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $commission_percent = Commission::latest()->first()->commission;
        DB::beginTransaction();

        try {
            $rate = Currency::latest()->first()->rate;
            if($request->currency == 'baht'){
                $totalAmount = $request->totalAmount * $rate;
            }else{
                $totalAmount = $request->totalAmount;
            }

            $user = Auth::user();
            $user->balance -= $totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('Insufficient balance.');
            }
            /** @var \App\Models\User $user */
            $user->save();
            // commission calculation
            if($totalAmount >= 1000){
                $commission = ($totalAmount * $commission_percent) / 100;
                $user->commission_balance += $commission;
                $user->save();
            }
            $lottery = Jackpot::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $request->user_id
            ]);

            foreach ($request->amounts as $amount) {
                $two_digit_string = $amount['num'];
                $sub_amount = $amount['amount'];

                $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                    ->where('two_digit_id', $two_digit_id)
                    ->sum('sub_amount');
                $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                $overLimit = $sub_amount - $withinLimit;
                //currency auto exchange
                if($request->currency == "baht"){
                    $sub_amount = $sub_amount * $rate;
                }

                if ($totalBetAmountForTwoDigit >= 0) {
                    $pivot = new JackpotTwoDigitCopy([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } 

                if ($overLimit > 0) {
                    $pivotOver = new JackpotTwoDigitOver([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $overLimit,
                        'prize_sent' => false
                    ]);
                    $pivotOver->save();
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Successfully placed bet.',
                'status' => 'success',
                'data' => $lottery
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An error occurred while placing the bet: ' . $e->getMessage()], 500);
        }
    }

    public function OnceMonthJackpotHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthJackpotDigits($userId);
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }
}