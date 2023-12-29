<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthApi\ProfileRequest;
use App\Models\Admin\Currency;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    use HttpResponses;
    public function profile()
    {
        $rate = Currency::latest()->first()->rate;
        return $this->success([
            "user" => Auth::user(),
            "currency_rate" => $rate
        ]);
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated($request->all());
        $user = Auth::user();
        if($user->profile){
            File::delete(public_path('assets/img/profile/' . $user->profile));
        }
        if($request->hasFile('profile'))
        {
            $image = $request->file('profile');
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid('profile') . '.' . $ext;
            $image->move(public_path('assets/img/profile/'), $filename);
        }else{
            $filename = $user->profile;
        }

        $user->update([
            "name" => $request->name ?? $user->name,
            "phone" => $request->phone ?? $user->phone,
            "profile" => $filename,
        ]);
        return $this->success([
            "message" => "Profile updated successfully",
        ]);
    }
}
