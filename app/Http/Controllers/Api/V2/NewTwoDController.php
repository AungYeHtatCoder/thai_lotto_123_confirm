<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Services\TwoDService;
use App\Traits\HttpResponses;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\TwoDLimit;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\LotteryMatch;
use App\Models\LotteryTwoDigitCopy;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\TwoDLotteryService;
use App\Http\Requests\TwoDPlayRequest;

class NewTwoDController extends Controller
{
    use HttpResponses;
    protected $lotteryService;

    public function __construct(TwoDLotteryService $lotteryService)
    {
        $this->middleware('auth'); // Ensure user is authenticated
        $this->lotteryService = $lotteryService;
    }
    public function index()
    {
        $digits = TwoDigit::all();
        $break = TwoDLimit::latest()->first()->two_d_limit;
        foreach($digits as $digit)
        {
            $totalAmount = LotteryTwoDigitCopy::where('two_digit_id', $digit->id)->sum('sub_amount');
            $remaining = $break-$totalAmount;
            $digit->remaining = $remaining;
        }
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first(['id', 'match_name', 'is_active']);
        return $this->success([
            'break' => $break,
            'two_digits' => $digits,
            'lottery_matches' => $lottery_matches
        ]);
    }

    public function play(TwoDPlayRequest $request, TwoDService $twoDService): JsonResponse
    {
        //Log::info($request->all());
    // Retrieve the validated data from the request
    $totalAmount = $request->input('totalAmount');
    $amounts = $request->input('amounts');
    $currency = $request->input('currency');

    try {
        // Pass the validated data to the TwoDService
        $result = $twoDService->play($totalAmount, $amounts, $currency);

        if ($result == "Insufficient funds.") {
            $message = "လက်ကျန်ငွေ မလုံလောက်ပါ။";
        } elseif (is_array($result)) {
            // return response()->json($result);
            $digit = [];
            foreach($result as $k => $r){
                $digit[] = TwoDigit::find($result[$k]+1)->two_digit;
            }
            $d = implode(",",$digit);
            $message = $d." ဂဏန်းမှာ သတ်မှတ် Limit ထက်ကျော်လွန်နေပါသည်။";
        } else {
            return $this->success($result);
        }
        
        return response()->json(['message' => $message], 401);
        
        // Assuming the service will handle exceptions and return a suitable result
        
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Bet placed successfully.',
        //     'data' => $result
        // ]);
    } catch (\Exception $e) {
        // In case of an exception, return an error response
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 401); // Use appropriate status code for client errors (e.g., 400) or server errors (e.g., 500)
    }
}
}