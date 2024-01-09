<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\CashRequest;
use App\Models\Admin\CashInRequest;
use App\Models\Admin\Currency;
use App\Models\Admin\TransferLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CashInRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashes = CashInRequest::latest()->get();
        return view('admin.cash_requests.cash_in', compact('cashes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'last_6_num' => 'required',
            'amount' => 'required|numeric',
            'phone' => 'required|numeric',
            'name' => 'required|string',
            'currency' => 'required|string',
        ]);
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
        return redirect()->back()->with('success', 'Cash In Request Submitted Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cash = CashInRequest::find($id);
        return view('admin.cash_requests.cash_in_detail', compact('cash'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        $cash = CashInRequest::find($id);
        $cash->status = $cash->status == 1 ? 0 : 1;
        $cash->save();
        return redirect()->back()->with('success', 'Filled the cash into user successfully');
    }

    public function transfer(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string'
        ]);
        $user = User::find($id);
        if($request->currency == 'kyat')
        {
            $user->balance += $request->amount;
            TransferLog::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'status' => "deposit",
                'created_by' => auth()->user()->id,
            ]);
        }else{
            $rate = Currency::latest()->first()->rate;
            $user->balance += $request->amount * $rate;
            TransferLog::create([
                'user_id' => $user->id,
                'amount' => $request->amount * $rate,
                'status' => "deposit",
                'created_by' => auth()->user()->id,
            ]);
        }
        $user->save();
        return redirect()->back()->with('success', 'Transfered the cash into user successfully');
    }
}