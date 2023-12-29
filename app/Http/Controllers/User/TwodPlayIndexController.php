<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryMatch;
use App\Http\Controllers\Controller;

class TwodPlayIndexController extends Controller
{
    public function index()
    {
        //return view('frontend.two_d.twoD');
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();
        return view('two_d.play_two_d_index', compact('lottery_matches'));
    }
}