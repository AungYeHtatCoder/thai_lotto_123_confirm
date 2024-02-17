<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\LottoService;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\ThreeDigit;
use App\Http\Requests\ThreedPlayRequest;

class NewThreeDController extends Controller
{
    use HttpResponses;
    protected $lottoService;

    public function __construct(LottoService $lottoService)
    {
        $this->lottoService = $lottoService;
    }
    public function index()
    {
        $digits = ThreeDigit::all();
        $break = ThreeDDLimit::latest()->first()->three_d_limit;
        foreach($digits as $digit){
            $totalAmount = DB::table('lotto_three_digit_copy')->where('three_digit_id', $digit->id)->sum('sub_amount');
            $break = ThreeDDLimit::latest()->first()->three_d_limit;
            $remaining = $break-$totalAmount;
            $digit->remaining = $remaining;
        }
        $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first(['id', 'match_name', 'is_active']);
        return $this->success([
            'digits' => $digits,
            'break' => $break,
            'lottery_matches' => $lottery_matches
        ]);
    }

     public function play(ThreedPlayRequest $request): JsonResponse
    {
        //Log::info($request->all());
        $totalAmount = $request->input('totalAmount');
        $amounts = $request->input('amounts');
        $currency = $request->input('currency');

        // if($totalAmount > Auth::user()->balance){
        //     return response()->json(['success' => false, 'message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
        // }

        $result = $this->lottoService->play($totalAmount, $amounts, $currency);
        // return response()->json($result);
        if ($result == "Insufficient funds.") {
            $message = "လက်ကျန်ငွေ မလုံလောက်ပါ။";
        } elseif (is_array($result)) {
            // return response()->json($result);
            $digit = [];
            foreach($result as $k => $r){
                $digit[] = ThreeDigit::find($result[$k]+1)->three_digit;
            }
            // return response()->json($digit);
            $d = implode(",",$digit);
            // return response()->json($d);
            $message = $d." ဂဏန်းမှာ သတ်မှတ် Limit ထက်ကျော်လွန်နေပါသည်။";
        } else {
            return $this->success($result);
        }

        return response()->json(['message' => $message], 401);

        // Assuming the service will handle exceptions and return a suitable result.
        // return response()->json(['success' => true, 'message' => 'Bet placed successfully.', 'data' => $result]);
    }

}