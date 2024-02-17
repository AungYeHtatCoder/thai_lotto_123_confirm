<?php

namespace App\Models\ThreeDigit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahtBreak extends Model
{
    use HasFactory;
    protected $table = 'baht_breaks';
    protected $fillable = ['baht_limit'];
}