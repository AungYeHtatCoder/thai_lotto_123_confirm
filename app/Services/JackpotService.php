<?php

namespace App\Services;

use App\Models\User\Jackpot;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\TwoDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Jackpot\JackpotLimit;
use App\Models\ThreeDigit\BahtBreak;
use App\Models\User\JackpotTwoDigit;
use Illuminate\Support\Facades\Auth;
use App\Models\User\JackpotTwoDigitCopy;

class JackpotService
{
     public function play($totalAmount, $amounts, $currency)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if ($user->balance < $totalAmount) {
                // throw new \Exception('Insufficient funds.');
                // return response()->json(['message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
                return "Insufficient funds.";
            }

            $preOver = [];
            foreach ($amounts as $amount) {
                $preCheck = $this->preProcessAmountCheck($amount, $currency);
                if(is_array($preCheck)){
                    $preOver[] = $preCheck[0];
                }
            }
            if(!empty($preOver)){
                return $preOver;
            }


            $lottery = Jackpot::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
                //'session' => $this->determineSession(),
            ]);

            $over = [];
            foreach ($amounts as $amount) {
                $check = $this->processAmount($amount, $lottery->id, $currency);
                if(is_array($check)){
                    $over[] = $check[0];
                }
            }
            if(!empty($over)){
                return $over;
            }

            /** @var \App\Models\User $user */
            $user->balance -= $totalAmount;
            $user->save();

            DB::commit();

            // return ['message' => 'Bet placed successfully'];
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in JackpotService play method: ' . $e->getMessage());
            //return ['error' => $e->getMessage()];
            // Rethrow the exception to be handled by the global exception handler
            // 401 is the status code for Unauthorized
            return response()->json(['message'=> $e->getMessage()], 401);
        }
    }

     protected function preProcessAmountCheck($amount, $currency)
    {
        $twoDigit = TwoDigit::where('two_digit', sprintf('%02d', $amount['num']))->firstOrFail();
        //$break = JackpotLimit::latest()->first()->jack_limit;
        $break = $currency == 'mmk' ? JackpotLimit::latest()->first()->jack_limit : BahtBreak::latest()->first()->baht_limit;
        $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                                       ->where('two_digit_id', $twoDigit->id)
                                       ->sum('sub_amount');
        $subAmount = $amount['amount'];

        if ($totalBetAmountForTwoDigit + $subAmount > $break) {
            return [$amount['num']];
            // throw new \Exception('The bet amount exceeds the limit for two-digit number ' . $twoDigit->two_digit);
        }
    }

    protected function processAmount($amount, $lotteryId, $currency)
    {
         $this->preProcessAmountCheck($amount, $currency);
        $twoDigit = TwoDigit::where('two_digit', sprintf('%02d', $amount['num']))->firstOrFail();
        //$break = JackpotLimit::latest()->first()->jack_limit;
         $break = $currency == 'mmk' ? JackpotLimit::latest()->first()->jack_limit : BahtBreak::latest()->first()->baht_limit;
        $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                                       ->where('two_digit_id', $twoDigit->id)
                                       ->sum('sub_amount');

        if ($totalBetAmountForTwoDigit + $amount['amount'] <= $break) {
            JackpotTwoDigit::create([
                'jackpot_id' => $lotteryId,
                'two_digit_id' => $twoDigit->id,
                'sub_amount' => $amount['amount'],
                'prize_sent' => false, // 'prize_sent' is a boolean field, so it should be '0' or '1
                'currency' => $currency,
            ]);
        } else {
            // Handle the case where the bet exceeds the limit
            return [$amount['num']];
            // throw new \Exception('The bet amount exceeds the limit for two-digit number ' . $twoDigit->two_digit);
        }
    }
}