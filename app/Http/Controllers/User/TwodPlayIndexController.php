<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryMatch;
use App\Http\Controllers\Controller;

class TwodPlayIndexController extends Controller
{
    public function index()
    {
        return view('frontend.two_d.twod');
    }
}
