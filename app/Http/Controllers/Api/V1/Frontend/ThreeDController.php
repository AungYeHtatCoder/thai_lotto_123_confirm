<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\ThreeDigit;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ThreeDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = ThreeDigit::all();
        return $this->success('digits', $digits);
    }
}
