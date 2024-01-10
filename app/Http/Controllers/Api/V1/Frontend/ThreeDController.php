<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\ThreedDigit;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ThreeDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = ThreedDigit::all();
        return $this->success('digits', $digits);
    }
}
