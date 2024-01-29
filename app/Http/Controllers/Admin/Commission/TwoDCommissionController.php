<?php

namespace App\Http\Controllers\Admin\Commission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;
use Illuminate\Support\Facades\DB;

class TwoDCommissionController extends Controller
{
   public function getTwoDTotalAmountPerUser()
    {
        $totalAmounts = Lottery::join('users', 'lotteries.user_id', '=', 'users.id')
            ->select('users.name', 'lotteries.user_id', DB::raw('SUM(lotteries.total_amount) as total_amount'))
            ->groupBy('lotteries.user_id', 'users.name')
            ->get();

        return view('admin.commission.two_d_commission_index', ['totalAmounts' => $totalAmounts]);
    } 
}