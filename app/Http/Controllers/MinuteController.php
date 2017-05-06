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
        if(!Helpers\validateInput($note_code)) return('error');

        $note = Notes::where('note_code', '=', $note_code)
                        ->select('origin', 'note_code', 'title', 'date',
                            'start_time', 'end_time', 'location', 'chairman',
                            'note_taker', 'attend_committee', 'attend_unit')
                        ->first();
        $cases = Cases::where('note_code', '=', $note_code)
                        ->pluck('case_code');

        $minute = Helpers\loadInformation($note['original']);
        $minute['cases'] = [];
        foreach($cases as $case) {
            $case_link = "/api/minutes/$admin-$period-$session-$round/cases/$case";
            array_push($minute['cases'], $case_link);
        }
        $output = json_encode($minute, JSON_UNESCAPED_UNICODE);

        return($output);
    }

    public function getCaseFromMinute($admin, $period, $session, $round, $case_id)
    {
        $note_code = $admin.$period.$session.$round;
        if(!Helpers\validateInput($note_code)) return('error');
        $case = Cases::where('note_code', '=', $note_code)
                        ->where('case_code', '=', $case_id)
                        ->select('note_code', 'type', 'case_title',
                            'case_code', 'description', 'committee_speak',
                            'response', 'adhoc', 'resolution', 'add_resolution',
                            'attached')
                            ->first();

        $petitions = Petitions::where('case_code', '=', $case_id)
                                ->select('petition_case', 'petition_num', 'name',
                                    'location', 'reason', 'suggest', 'response',
                                    'adhoc', 'resolution')
                                ->get();

        $output = $case['original'];
        $output['petitions'] = [];

        foreach ($petitions as $petition) {
            array_push($output['petitions'], $petition['original']);
        }

        $output = json_encode($output, JSON_UNESCAPED_UNICODE);

        return($output);
    }
}
