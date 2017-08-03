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
        $caseList = Cases::where('note_code', '=', $note_code)
                        ->select('case_code', 'case_title', 'type')
                        ->get();

        $minute = Helpers\loadInformation($note['original']);

        $minute['cases'] = [];
        $host = $_SERVER['HTTP_HOST'];
        foreach($caseList as $case) {
            $caseContent = Helpers\loadInformation($case['original']);
            $caseCode = $caseContent['case_id'];
            $caseTitle = '';
            if(isset($caseContent['case_title'])) {
                $caseTitle = implode("", $caseContent['case_title']);
            }
            $casePack =[];
            $casePack['case_title'] = $caseTitle;
            $casePack['type'] = $caseContent['type'];
            $casePack['url'] = "$host/api/minutes/$admin-$period-$session-$round/cases/$caseCode";
            array_push($minute['cases'], $casePack);
        }
        $output = json_encode($minute, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

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

        $output = Helpers\loadInformation($case['original']);
        $output['petitions'] = [];

        foreach ($petitions as $petition) {
            $petitionContent = Helpers\loadInformation($petition['original']);
            array_push($output['petitions'], $petitionContent);
        }

        $output = json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return($output);
    }
}
