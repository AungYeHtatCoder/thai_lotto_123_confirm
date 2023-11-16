<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Withdraw;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithDrawController extends Controller
{
    public function GetWithdraw()
    {
        return view('frontend.withdraw_money');
    }
    public function UserKpayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('kpay_no')->first();
        return view('frontend.kpay_withdraw', compact('user'));
    }
    public function UserCBPayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('cbpay_no')->first();
        return view('frontend.cb_pay_withdraw', compact('user'));
        
        
    }

    public function UserWavePayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('wavepay_no')->first();
        return view('frontend.wave_pay_withdraw', compact('user'));
        
        
    }
    public function UserAYAPayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('ayapay_no')->first();
        return view('frontend.aya_pay_withdraw', compact('user'));
        
        
    }

    public function StoreKpayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'kpay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->kpay_no = $request->kpay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး .');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreCBpayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'cbpay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->cbpay_no = $request->cbpay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး .');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreWavepayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'wavepay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->wavepay_no = $request->wavepay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး .');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreAYApayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'ayapay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->ayapay_no = $request->ayapay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး .');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }
}