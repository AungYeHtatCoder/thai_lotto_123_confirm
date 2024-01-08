<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Models\ThreeDigit\Lotto;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ThreeDUpdatePrizeSent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $threedWinner;

    public function __construct($threedWinner)
    {
        $this->threedWinner = $threedWinner;
    }

    public function handle()
{
    // Check if today is a playing day
    $today = Carbon::today();
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        return; // exit if it's not a playing day
    }

         $winningEntries = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('three_digits', 'lotto_three_digit_pivot.three_digit_id', '=', 'three_digits.id')
        ->whereRaw('three_digits.three_digit = ?', [$this->threedWinner->prize_no])
        ->whereRaw('lotto_three_digit_pivot.prize_sent = 0')
        ->whereRaw('DATE(lotto_three_digit_pivot.created_at) = ?', [$today])
        ->select('lotto_three_digit_pivot.*') // Select all columns from pivot table
        ->get();
    foreach ($winningEntries as $entry) {
        DB::transaction(function () use ($entry) {
            // Retrieve the lottery for this entry
            $lottery = Lotto::findOrFail($entry->lotto_id);
            $methodToUpdatePivot = 'threedDigits';
            // Update prize_sent in pivot
            $lottery->$methodToUpdatePivot()->updateExistingPivot($entry->three_digit_id, ['prize_sent' => 1]);
        });
    }
}
}