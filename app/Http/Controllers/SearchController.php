<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases as Cases;

class SearchController extends Controller
{
    public function globalSearch(Request $request) {//$searchQuery) {
        if(!isset($request['q'])) return;

        $searchQuery = $request['q'];
        $searchOutputs = Cases::where('case_title', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('description', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('committee_speak', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('response', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('adhoc', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('resolution', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('add_resolution', 'LIKE', '%'.$searchQuery.'%')
                                ->orWhere('attached', 'LIKE', '%'.$searchQuery.'%')
                                ->select('note_code', 'type', 'case_title', 'case_code')
                                ->get();

        $outputCount = count($searchOutputs);

        $output = [];
        $output['query'] = $searchQuery;
        $output['count'] = $outputCount;

        $caseList = [];
        foreach ($searchOutputs as $queryOutput) {
            $queryOutput = $queryOutput['original'];
            array_push($caseList, $queryOutput);
        }

        $output['cases'] = $caseList;

        $output = json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return($output);
    }
}
