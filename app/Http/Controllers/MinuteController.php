<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes as Notes;
use App\Cases as Cases;
use App\Petitions as Petitions;
use App\Helpers as Helpers;

class MinuteController extends Controller
{
    public function getMinutes($admin, $period, $session, $round)
    {
        $note_code = $admin.$period.$session.$round;
        $note_code = preg_replace("/-/", "", $note_code);
        if(!Helpers\validateInput($note_code)) return('error');

        $notes = Notes::where('note_code', '=', $note_code)
                        ->select('origin', 'note_code', 'title', 'date',
                            'start_time', 'end_time', 'location', 'chairman',
                            'note_taker', 'attend_committee', 'attend_unit')
                        ->get();
        $cases = Cases::where('note_code', '=', $note_code)
                        ->pluck('case_code');

        foreach ($notes as $note) {
            $minute = Helpers\loadInformation($note['original']);
            $minute['cases'] = [];
            foreach($cases as $case) {
                $case_link = "/api/minutes/$admin-$period-$session-$round/cases/$case";
                array_push($minute['cases'], $case_link);
            }
            print_r($minute);
            echo PHP_EOL;
            $output = json_encode($minute, JSON_UNESCAPED_UNICODE);
        }
        // return($output);
    }
}
