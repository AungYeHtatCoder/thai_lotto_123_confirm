<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $roles = Auth::user()->roles;
        foreach($roles as $role)
        {
            if($role->title == "Admin")
            {
                $currency = Currency::latest()->first();
                return view('admin.profile.admin_profile', compact('currency'));
            }else
            {
                return view('frontend.user-profile'); 
            }
        }
        
    }

    public function update(UserRequest $request, User $user)
    {
        $request->validate([
            'profile' => 'required|image'
        ]);
        if (Auth::user()->profile) {
            //remove banner from localstorage
            File::delete(public_path('assets/img/profile/' . $user->profile));
        }
        // image
        $image = $request->file('profile');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('profile') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/profile/'), $filename); // Save the file

        Auth::user()->update([
            'profile' => $filename,
        ]);

        return redirect()->back()->with('toast_success', 'Profile updated successfully');
    }

    public function editInfo(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => ['nullable', 'string', 'min:11'],

        ]);

        $user = User::find(Auth::id());

        if (
            $request->phone !== $user->phone
        ) {

            $existingPhone = User::where("phone", $request->phone)->first();

            if ($existingPhone && $existingPhone->id !== $user->id) {
                return redirect()->back()->with("error", "The phone has already been taken.");
            }
        }

        $user->update([
            "name" => $request->name,
            "phone" => $request->phone ?? $user->phone,

        ]);

        return redirect()->back()->with("success", "User info updated successfully.");
    }

    public function changePassword(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',

        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            if (auth()->user()->hasRole('Admin')) {
                return redirect()->back()->with('toast_success', "Admin Password has been  Updated.");
            } else {
                return redirect()->back()->with('toast_success', "Customer Password has been Updated.");
            }
        } else {
            return redirect()->back()->with('error', "Old password does not match!");
        }
    }
}
