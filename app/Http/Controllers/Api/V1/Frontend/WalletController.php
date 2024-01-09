<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Bank;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    use HttpResponses;
    public function banks()
    {
        $banks = Bank::all();
        return $this->success([
            "banks" => $banks
        ]);
    }

    public function bankDetail($id)
    {
        $bank = Bank::find($id);
        return $this->success([
            "bank" => $bank
        ]);
    }
}
