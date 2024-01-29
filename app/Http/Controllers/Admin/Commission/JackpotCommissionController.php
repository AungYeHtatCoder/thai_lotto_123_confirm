<?php

namespace App\Http\Controllers\Admin\Commission;

use Illuminate\Http\Request;
use App\Models\Jackpot\Jackpot;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JackpotCommissionController extends Controller
{
    public function getJackpotTotalAmountPerUser()
    {
        $totalAmounts = Jackpot::join('users', 'jackpots.user_id', '=', 'users.id')
            ->select('users.name', 'jackpots.user_id', DB::raw('SUM(jackpots.total_amount) as total_amount'))
            ->groupBy('jackpots.user_id', 'users.name')
            ->get();

        return view('admin.commission.jackpot_commission_index', ['totalAmounts' => $totalAmounts]);
    } 
}