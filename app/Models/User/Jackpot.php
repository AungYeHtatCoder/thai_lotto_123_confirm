<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\Admin\TwoDigit;
use App\Models\User\Jackmatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jackpot extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_amount',
        'total_amount',
        'user_id',
        'jackmatch_id'
    ];
    protected $dates = ['created_at', 'updated_at'];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function JackMatch()
    {
        return $this->belongsTo(Jackmatch::class, 'jackmatch_id');
    }

    public function twoDigits() {
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit')->withPivot('sub_amount', 'prize_sent')->withTimestamps();
    }

}