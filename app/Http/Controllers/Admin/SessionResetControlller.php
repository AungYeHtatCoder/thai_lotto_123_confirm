<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LotteryTwoDigitCopy;
use App\Http\Controllers\Controller;

class SessionResetControlller extends Controller
{
    public function index()
    {
        
        return view('admin.two_d.session_reset');
    }

    public function SessionReset()
    {
         LotteryTwoDigitCopy::truncate();

    return redirect()->back()->with('message', 'Data reset successfully!');
    }
}