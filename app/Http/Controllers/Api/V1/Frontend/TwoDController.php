<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\TwoDigit;
use App\Models\Lottery;
use App\Models\LotteryTwoDigitPivot;
use App\Models\Two\LotteryTwoDigitOverLimit;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TwoDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = TwoDigit::all();
        return $this->success($digits);
    }

    public function play(Request $request)
    {
        // Log the entire request
        Log::info($request->all());
    
        // Convert JSON request to an array
        $data = $request->json()->all();
    
        // Validate the incoming data
        $validator = Validator::make($data, [
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1|max:50000',
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Extract validated data
        $validatedData = $validator->validated();
    
        // Determine the current session based on time
        $currentSession = date('H') < 12 ? 'morning' : 'evening';
        $limitAmount = 50000;
        if ($validatedData['totalAmount'] > $limitAmount) {
            return response()->json(['error' => 'Total Amount is over limit'], 422);
        }
    
        // Start database transaction
        DB::beginTransaction();
    
        try {
            // Assuming the user is authenticated and you want to use their ID
            $user = Auth::user();
            $user->balance -= $validatedData['totalAmount'];
    
            // Check if the user has sufficient balance
            if ($user->balance < 0) {
                return response()->json(['error' => 'Insufficient balance'], 422);
            }

    
            $user->save();
    
            // Create a new lottery entry
            $lottery = Lottery::create([
                'pay_amount' => $validatedData['totalAmount'],
                'total_amount' => $validatedData['totalAmount'],
                'user_id' => $user->id, // Use authenticated user's ID
                'session' => $currentSession
            ]);
    
            // Iterate through each bet and process it
            foreach ($validatedData['amounts'] as $bet) {
                $two_digit_id = $bet['num'] === 0 ? 100 : $bet['num']; // Assuming '00' corresponds to 100
    
                // ... Your betting logic here ...
    
                // Example: create a bet entry (adjust according to your actual table and column names)
                LotteryTwoDigitPivot::create([
                    'lottery_id' => $lottery->id,
                    'two_digit_id' => $two_digit_id,
                    'sub_amount' => $bet['amount'],
                    'prize_sent' => false
                ]);
    
                // Add any additional logic for handling limits or other rules
            }
    
            // Commit the transaction
            DB::commit();
    
            // Return a success response
            return response()->json(['message' => 'Bet placed successfully'], 200);
        } catch (\Exception $e) {
            // Roll back the transaction in case of error
            DB::rollback();
            Log::error('Error in play method: ' . $e->getMessage());
    
            // Return an error response
            return response()->json(['error' => 'An error occurred while placing the bet: ' . $e->getMessage()], 500);
        }
    }
}
