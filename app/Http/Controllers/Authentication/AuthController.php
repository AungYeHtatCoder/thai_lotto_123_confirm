<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Admin\CountryCode;
use App\Models\User;
use App\Rules\UniquePhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function loginForm()
    {
        if(Auth::check()){
            return redirect()->back()->with('error', "Already Logged In.");
        }
        $countryCodes = CountryCode::all();
        return view('frontend.login', compact('countryCodes'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'country_code' => 'required',
            'phone' => ['required', new UniquePhone()],
            'password' => 'required|min:6'
        ]);
        $credentials = $request->only('country_code','phone', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', "Login Successfully.");
        }
        return redirect()->back()->with(['error' => 'Invalid credentials']);
    }

    public function registerForm()
    {
        if(Auth::check()){
            return redirect()->back()->with('error', "Already Logged In.");
        }
        $countryCodes = CountryCode::all();
        return view('frontend.register', compact('countryCodes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:6']
        ]);
        $user = User::create([
            'name' => $request->name,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Registration successful');
    }
}
