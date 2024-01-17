<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Admin\Role;
use App\Models\Admin\Event;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwodWiner;
use App\Models\Admin\BetLottery;
use App\Models\Admin\Permission;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\FillBalance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\LotteryTwoDigit;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_code',
        'phone',
        'profile',
        'email',
        'password',
        'address',
        'kpay_no',
        'cbpay_no',
        'wavepay_no',
        'ayapay_no',
        'balance',
    ];
    protected $appends = ['img_url'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsUserAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }


    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // public function event()
    // {
    //     return $this->hasOne(Event::class);
    // }


    public function hasRole($role)
    {
        return $this->roles->contains('title', $role);
    }

    public function hasPermission($permission)
    {
        return $this->roles->flatMap->permissions->pluck('title')->contains($permission);
    }

    public function lotteries()
{
    return $this->hasMany(Lottery::class);
}

public function twodWiners()
    {
        return $this->belongsToMany(TwodWiner::class);
    }

 public function balancedecrement($column, $amount = 1)
    {
        $this->$column = $this->$column - $amount;
        return $this->save();
    }
   
    public function fillBalances()
    {
        return $this->hasMany(FillBalance::class);
    }

    public static function getUserEarlyMorningTwoDigits($userId) {
    $morningTwoDigits = Lottery::where('user_id', $userId)
                               ->with('twoDigitsEarlyMorning')
                               ->get()
                               ->pluck('twoDigitsEarlyMorning')
                               ->collapse(); // Collapse the collection to a single dimension

    // Sum the sub_amount from the pivot table
    $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
        return $twoDigit->pivot->sub_amount;
    });

    return [
        'two_digits' => $morningTwoDigits,
        'total_amount' => $totalAmount
    ];
}

    public static function getUserMorningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsMorning')
                                ->get()
                                ->pluck('twoDigitsMorning')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }

    public static function getUserEarlyEveningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsEarlyEvening')
                                ->get()
                                ->pluck('twoDigitsEarlyEvening')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }


    public static function getUserEveningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsEvening')
                                ->get()
                                ->pluck('twoDigitsEvening')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }

    // three d
    public function betLotteries()
    {
        return $this->hasMany(BetLottery::class);
    }

    public function getImgUrlAttribute()
    {
        return asset('assets/img/profile/' . $this->profile);
    }
//     public static function getUserThreeDigits($userId) {
//     $displayThreeDigitsQuery = Lotto::where('user_id', $userId)->with('DisplayThreeDigits');

//     // Ensure we clone the query since it is executed once `get()` is called
//     $displayThreeDigits = (clone $displayThreeDigitsQuery)->get()
//                                ->pluck('DisplayThreeDigits')
//                                ->collapse(); 

//     $totalAmount = $displayThreeDigits->sum('pivot.sub_amount');

//     // DisplayThreeDigitsOver
//     $displayThreeDigitsOver = (clone $displayThreeDigitsQuery)->with('DisplayThreeDigitsOver')
//                                ->get()
//                                ->pluck('DisplayThreeDigitsOver')
//                                ->collapse();

//     $totalAmountOver = $displayThreeDigitsOver->sum('pivot.sub_amount');

//     // Merge the collections
//     $mergedCollection = $displayThreeDigits->merge($displayThreeDigitsOver);

//     // Now if you want to return an array, convert the merged collection to an array
//     $mergedArray = $mergedCollection->toArray();

//     $totalAmountBoth = $totalAmount + $totalAmountOver;

//     return [
//         'threeDigit' => $mergedArray, // This is now a merged array
//         'total_amount' => $totalAmount,
//         'threeDigitOver' => $displayThreeDigitsOver->toArray(), // Keep as an array if needed separately
//         'total_amount_over' => $totalAmountOver,
//         'total_amount_both' => $totalAmountBoth
//     ];
// }

    public static function getUserThreeDigits($userId) {
    $displayThreeDigits = Lotto::where('user_id', $userId)
                               ->with('DisplayThreeDigits')
                               ->get()
                               ->pluck('DisplayThreeDigits')
                               ->collapse(); 
    $totalAmount = $displayThreeDigits->sum(function ($threeDigit) {
        return $threeDigit->pivot->sub_amount;
    });
    // DisplayThreeDigitsOver
    $displayThreeDigitsOver = Lotto::where('user_id', $userId)
                               ->with('DisplayThreeDigitsOver')
                               ->get()
                               ->pluck('DisplayThreeDigitsOver')
                               ->collapse();
    $totalAmountOver = $displayThreeDigitsOver->sum(function ($threeDigit) {
        return $threeDigit->pivot->sub_amount;
    });
    $totalAmountBoth = $totalAmount + $totalAmountOver;
    return [
        'threeDigit' => $displayThreeDigits,
        'total_amount' => $totalAmount,
        'threeDigitOver' => $displayThreeDigitsOver,
        'total_amount_over' => $totalAmountOver,
        'total_amount_both' => $totalAmountBoth
    ];
}

}