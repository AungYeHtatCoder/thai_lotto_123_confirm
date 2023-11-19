<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPlayTwoDHistoryRecordController extends Controller
{
    public function MorningPlayHistoryRecord(){
        $userId = auth()->id(); // Get logged in user's ID
        $playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        //$playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('two_d.morning-history-record', [
            'morningDigits' => $playedMorningTwoDigits,
            //'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }

    public function EveningPlayHistoryRecord(){
        $userId = auth()->id(); // Get logged in user's ID
        //$playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('two_d.evening-history-record', [
           // 'morningDigits' => $playedMorningTwoDigits,
            'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }
}