<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthApi\DepositRequest;
use App\Http\Requests\AuthApi\WithdrawRequest;
use App\Mail\CashRequest;
use App\Models\Admin\Bank;
use App\Models\Admin\CashInRequest;
use App\Models\Admin\CashOutRequest;
use App\Models\Admin\Currency;
use App\Models\Admin\TransferLog;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function deposit(DepositRequest $request)
    {
        $request->validated($request->all());
        CashInRequest::create([
            'payment_method' => $request->payment_method,
            'last_6_num' => $request->last_6_num,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'name' => $request->name,
            'currency' => $request->currency,
            'user_id' => auth()->user()->id,
        ]);
        $user = User::find(auth()->id());
        $rate = Currency::latest()->first()->rate;
        $toMail = "delightdeveloper4@gmail.com";
        $mail = [
            'status' => "Deposit",
            'name' => $user->name,
            'balance' => $user->balance,
            'receiver' => $request->name,
            'payment_method'=> $request->payment_method,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'last_6_num' => $request->last_6_num,
            'currency' => $request->currency,
            'rate' => $rate,
        ];
        Mail::to($toMail)->send(new CashRequest($mail));
        return $this->success([
            "message" => "Deposit request submitted successfully",
        ]);
    }

    public function withdraw(WithdrawRequest $request)
    {
        $request->validated($request->all());
        if($request->currency == "baht"){
            $rate = Currency::latest()->first()->rate;
            $balance = auth()->user()->balance / $rate;
            if($request->amount > $balance){
                return $this->error("Insufficient balance");
            }
        }
        if($request->amount > auth()->user()->balance){
            return $this->error("Insufficient balance");
        }
        CashOutRequest::create([
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'name' => $request->name,
            'user_id' => auth()->id(),
            'currency' => $request->currency,
        ]);
        $user = User::find(auth()->id());
        $rate = Currency::latest()->first()->rate;
        $toMail = "delightdeveloper4@gmail.com";
        $mail = [
            'status' => "Withdraw",
            'name' => $user->name,
            'receiver' => $request->name,
            'balance' => $user->balance,
            'payment_method'=> $request->payment_method,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'rate' => $rate,
        ];
        Mail::to($toMail)->send(new CashRequest($mail));
        return $this->success([
            "message" => "Withdraw request submitted successfully",
        ]);
    }

    public function transferLog()
    {
        $logs = TransferLog::where('user_id', auth()->id())->latest()->take(20)->get();
        return $this->success([
            "logs" => $logs,
        ]);
    }
}
