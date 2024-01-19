<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\JackpotTwoDigitCopy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JackpotTwoDigit extends Model
{
    use HasFactory;
    public function __construct(array $attributes = [])
{
    parent::__construct($attributes);
    self::boot();  // Ensure the model is booted
}

    protected $table = 'jackpot_two_digit';
    protected $fillable = ['jackpot_id', 'two_digit_id', 'sub_amount', 'prize_sent'];
    // This will automatically boot with the model's events
    protected static function booted()
    {
        static::created(function ($pivot) {
            JackpotTwoDigitCopy::create($pivot->toArray());
        });
    }
}