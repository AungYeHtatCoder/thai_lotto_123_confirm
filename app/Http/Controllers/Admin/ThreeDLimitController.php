<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\ThreeDDLimit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ThreeDLimitController extends Controller
{
    public function index()
    {
       $limits = ThreeDDLimit::all();
        return view('admin.three_limit.index', compact('limits'));
    }
    public function store(Request $request)
    {
       //dd($request->all());
        $validator = Validator::make($request->all(), [
        'three_d_limit' => 'required',

        //'body' => 'required|min:3'
    ]);

    if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
    }

        // store
        ThreeDDLimit::create([
            'three_d_limit' => $request->three_d_limit
        ]);
        // redirect
        return redirect()->route('admin.three-digit-limit.index')->with('toast_success', 'three d limit created successfully.');
    }

    public function destroy($id)
    {
        $limit = ThreeDDLimit::findOrFail($id);
        $limit->delete();
        return redirect()->route('admin.three-digit-limit.index')->with('toast_success', 'Limit deleted successfully.');
    }

}