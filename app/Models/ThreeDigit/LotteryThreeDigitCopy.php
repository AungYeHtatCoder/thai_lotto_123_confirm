<?php

namespace App\Models\ThreeDigit;

use Illuminate\Database\Eloquent\Model;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotteryThreeDigitCopy extends Model
{
    use HasFactory;
    protected $table = 'lotto_three_digit_copy';
    protected $fillable = ['three_digit_id', 'lotto_id', 'sub_amount', 'prize_sent'];

    // protected static function booted()
    // {
    //     static::created(function ($betLotteryMatchingCopy) {
    //         LotteryThreeDigitPivot::create([
    //             'three_digit_id' => $betLotteryMatchingCopy->matching_id,
    //             'lotto_id' => $betLotteryMatchingCopy->bet_lottery_id,
    //             'sub_amount' => $betLotteryMatchingCopy->sub_amount,
    //             'prize_sent' => $betLotteryMatchingCopy->prize_sent,
    //             'created_at' => $betLotteryMatchingCopy->created_at,
    //             'updated_at' => $betLotteryMatchingCopy->updated_at
    //         ]);
    //     });
    // }

}