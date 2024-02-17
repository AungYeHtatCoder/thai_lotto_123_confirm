<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\BahtBreak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BahtLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $limits = BahtBreak::all();
        return view('admin.three_limit.baht_break_index', compact('limits'));
    }
    public function store(Request $request)
    {
       //dd($request->all());
        $validator = Validator::make($request->all(), [
        'baht_limit' => 'required',

        //'body' => 'required|min:3'
    ]);

    if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
    }

        // store
        BahtBreak::create([
            'baht_limit' => $request->baht_limit
        ]);
        // redirect
        return redirect()->route('admin.baht-break-limit.index')->with('toast_success', 'baht  limit created successfully.');
    }

    public function destroy($id)
    {
        $limit = BahtBreak::findOrFail($id);
        $limit->delete();
        return redirect()->route('admin.baht-break-limit.index')->with('toast_success', 'Limit deleted successfully.');
    }

}