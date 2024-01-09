<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\CashRequest;
use App\Models\Admin\CashOutRequest;
use App\Models\Admin\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use NunoMaduro\Collision\Provider;

class CashOutRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashes = CashOutRequest::latest()->get();
        return view('admin.cash_requests.cash_out', compact('cashes'));
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
            'amount' => 'required|numeric',
            'phone' => 'required|numeric',
            'name' => 'required|string',
            'currency' => 'required'
        ]);
        if($request->currency == "baht"){
            $rate = Currency::latest()->first()->rate;
            $balance = auth()->user()->balance / $rate;
            if($request->amount > $balance){
                return redirect()->back()->with('error', 'Insufficient balance');
            }
        }
        if($request->amount > auth()->user()->balance){
            return redirect()->back()->with('error', 'Insufficient balance');
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
        // return $message;
        Mail::to($toMail)->send(new CashRequest($mail));
        return redirect()->back()->with('success', 'Withdraw request submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cash = CashOutRequest::find($id);
        return view('admin.cash_requests.cash_out_detail', compact('cash'));
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
}
