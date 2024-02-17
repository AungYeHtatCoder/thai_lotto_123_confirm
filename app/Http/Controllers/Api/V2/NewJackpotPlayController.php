<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Admin\TwoDigit;
use App\Services\JackpotService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\JackpotRequest;

class NewJackpotPlayController extends Controller
{
    use HttpResponses;
    protected $lotteryService;

    public function __construct(JackpotService $lotteryService)
    {
        $this->middleware('auth'); // Ensure user is authenticated
        $this->lotteryService = $lotteryService;
    }
    public function play(JackpotRequest $request, JackpotService $twoDService): JsonResponse
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