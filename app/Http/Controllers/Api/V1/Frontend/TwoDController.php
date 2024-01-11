<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\TwoDigit;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'selected_digits' => 'required|string',
            'amounts' => 'required|array',
            'amounts.*' => 'required|integer|max:50000',
            'totalAmount' => 'required|numeric', // Changed from integer to numeric
            'user_id' => 'required|exists:users,id',
        ]);
        $currentSession = date('H') < 12 ? 'morning' : 'evening';
        $limitAmount = 50000; // Define the limit amount
        
    }
}
