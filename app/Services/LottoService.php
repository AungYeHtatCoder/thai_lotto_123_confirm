<?php 

namespace App\Services;

use App\Models\Lotto;
use App\Models\ThreeDigit;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ThreeDigit\BahtBreak;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;

class LottoService
{
    // public function play($totalAmount, $amounts)
    // {
    //     // Begin Database Transaction
    //     DB::beginTransaction();

    //     try {
    //         // Retrieve the authenticated user
    //         $user = Auth::user();

    //         // Check if the user's balance is sufficient
    //         if ($user->balance < 0) {
    //             throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
    //         }

    //         // Save the user with the new balance
        

    //         // Create a new lottery record
    //         $lottery = Lotto::create([
    //             'total_amount' => $totalAmount,
    //             'user_id' => $user->id,
    //         ]);

    //         // Process each amount
    //         foreach ($amounts as $item) {
    //             $this->processAmount($item, $lottery);
    //         }
    //         /** @var \App\Models\User $user */
    //         $user->balance -= $totalAmount;
    //         $user->save();
            

    //         // Commit the transaction
    //         DB::commit();
            
    //         // Return the lottery data or other success indication
    //         return $lottery;
    //     } catch (\Exception $e) {
    //         // Rollback the transaction on error
    //         DB::rollback();
    //         // Log::error('Error in LottoService play method: ' . $e->getMessage());

    //         // Rethrow the exception to be handled by the global exception handler
    //         // throw $e;
    //         return response()->json(['message'=> $e->getMessage()], 401);
    //     }
    // }

     public function play($totalAmount, $amounts, $currency)
    {
        // Begin Transaction
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if ($user->balance < $totalAmount) {
                // throw new \Exception('Insufficient balance.');
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

            //$lottery = $this->createLottery($totalAmount, $user->id);
            $lottery = Lotto::create([
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
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

            $user->decrement('balance', $totalAmount);

            DB::commit();

            // return $lottery;
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;
             return response()->json(['message'=> $e->getMessage()], 401);
            //  return $e->getMessage();
        }
    }


    protected function preProcessAmountCheck($item, $currency)
{
    $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
    $sub_amount = $item['amount'];
    $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
    $totalBetAmount = DB::table('lotto_three_digit_copy')->where('three_digit_id', $three_digit->id)->sum('sub_amount');
    // for mmk break (currency will be mmk)
    //$break = ThreeDDLimit::latest()->first()->three_d_limit;
    // for baht break (currency will be baht)
    //$baht_break = BahtBreak::latest()->first()->baht_limit;
        // Determine the limit based on the currency again
   $break = $currency == 'mmk' ? ThreeDDLimit::latest()->first()->three_d_limit : BahtBreak::latest()->first()->baht_limit;
    if ($totalBetAmount + $sub_amount > $break) {
        // throw new \Exception("The bet amount for number $num exceeds the limit.");
        return [$item['num']];
    }
}

   protected function processAmount($item, $lotteryId, $currency)
{
    $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
    $sub_amount = $item['amount'];
    $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
    $totalBetAmount = DB::table('lotto_three_digit_copy')->where('three_digit_id', $three_digit->id)->sum('sub_amount');
    // for mmk break (currency will be mmk)
    //$break = ThreeDDLimit::latest()->first()->three_d_limit;
    // for baht break (currency will be baht)
    //$baht_break = BahtBreak::latest()->first()->baht_limit;
     // Determine the limit based on the currency again
    $break = $currency == 'mmk' ? ThreeDDLimit::latest()->first()->three_d_limit : BahtBreak::latest()->first()->baht_limit;
    if ($totalBetAmount + $sub_amount <= $break) {
        $pivot = new LotteryThreeDigitPivot([
            'lotto_id' => $lotteryId,
            'three_digit_id' => $three_digit->id,
            'sub_amount' => $sub_amount,
            'prize_sent' => false,
            'currency' => $currency, // Use the currency parameter
        ]);
        $pivot->save();
    } else {
        return [$item['num']];
    }
}

}