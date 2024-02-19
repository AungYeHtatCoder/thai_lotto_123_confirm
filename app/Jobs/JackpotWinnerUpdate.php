<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Jackpot\Jackpot;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JackpotWinnerUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $twodWiner;

    public function __construct($twodWiner)
    {
        $this->twodWiner = $twodWiner;
    }

    public function handle()
    {
        $today = Carbon::today();

        // Convert prize_no to two_digit_id
        $two_digit_id = $this->twodWiner->prize_no === '00' ? 1 : intval($this->twodWiner->prize_no, 10) + 1;

        $winningEntries = DB::table('jackpot_two_digit')
            ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
            ->where('two_digits.id', $two_digit_id) // Use the calculated two_digit_id
            ->where('jackpot_two_digit.prize_sent', false)
            ->whereDate('jackpot_two_digit.created_at', $today)
            ->select('jackpot_two_digit.*')
            ->get();

        foreach ($winningEntries as $entry) {
            DB::transaction(function () use ($entry) {
                $lottery = Jackpot::findOrFail($entry->jackpot_id);
                $methodToUpdatePivot = 'twoDigits'; // Method to update the pivot table
                // Update prize_sent in pivot table
                $lottery->$methodToUpdatePivot()->updateExistingPivot($entry->two_digit_id, ['prize_sent' => true]);
            });
        }
    }
}