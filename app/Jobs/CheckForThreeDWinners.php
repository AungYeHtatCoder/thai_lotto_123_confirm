<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Lotto;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CheckForThreeDWinners implements ShouldQueue
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


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Check if today is a playing day
    $today = Carbon::today();
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        return; // exit if it's not a playing day
    }

    $winningEntries = DB::table('lotto_three_digit_copy')
        ->join('lottos', 'lotto_three_digit_copy.lotto_id', '=', 'lottos.id')
        ->join('three_digits', 'lotto_three_digit_copy.three_digit_id', '=', 'three_digits.id')
        ->whereRaw('three_digits.three_digit = ?', [$this->threedWinner->prize_no])
        ->whereRaw('lotto_three_digit_copy.prize_sent = 0')
        ->whereRaw('DATE(lotto_three_digit_copy.created_at) = ?', [$today])
        ->select('lotto_three_digit_copy.*') // Select all columns from pivot table
        ->get();

        // Log::info('Winning entries count: ' . $winningEntries->count());
    foreach ($winningEntries as $entry) {
        DB::transaction(function () use ($entry) {
            // Retrieve the lottery for this entry
            $lottery = Lotto::findOrFail($entry->lotto_id);
            $methodToUpdatePivot = 'threedDigits';

            // Update user's balance
            $user = $lottery->user;
            $user->balance += $entry->sub_amount * 700;  // Update based on your prize calculation
            $user->save();

            // Update prize_sent in pivot
            $lottery->$methodToUpdatePivot()->updateExistingPivot($entry->three_digit_id, ['prize_sent' => 1]);
            // Log::info('Updated prize_sent for entry: ' . $entry->id);
        });
    }
}

}