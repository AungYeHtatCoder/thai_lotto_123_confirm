<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promo()
    {
        return view('frontend.promotion');
    }

    public function promoDetail()
    {
        return view('frontend.promoDetail');
    }
}
