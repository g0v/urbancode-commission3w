<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases as Cases;
use App\Helpers as Helpers;

class CaseController extends Controller
{
    public function getCases($case_id) {
        $caseType = array(
                        '0' => 'undefined',
                        '1' => '報告事項',
                        '2' => '確認事項',
                        '3' => '審議事項',
                        '4' => '討論事項',
                        '5' => '臨時動議'
                    );
        $host = $_SERVER['HTTP_HOST'];

        $caseList = Cases::where('case_code', '=', $case_id)
                        ->select('note_code', 'case_title', 'type')
                        ->get();

        $outputArray['case_id'] = $case_id;

        $list = [];
        foreach($caseList as $case) {
            $thisCase = Helpers\loadInformation($case['original']);
            if(isset($thisCase['case_title'])) {
                $thisCase['case_title'] = implode('', $thisCase['case_title']);
            }
            if(isset($thisCase['type'])) $thisCase['type'] = $caseType[$thisCase['type']];
            if(isset($thisCase['minute_id'])) {
                $minID = $thisCase['minute_id'];
                $admin = substr($minID, 0, 3);
                $period = substr($minID, 3, 1);
                $session = substr($minID, 4, 3);
                $round = substr($minID, 7, 1);
                $thisCase['url'] = "$host/api/minutes/$admin-$period-$session-$round/cases/$case_id";
            }
            array_push($list, $thisCase);
        }
        $outputArray['case_title'] = $list[0]['case_title'];
        $outputArray['query_list'] = $list;

        $output = json_encode($outputArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return($output);
    }
}
