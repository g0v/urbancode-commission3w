<?php

namespace App\Helpers;

use Aura\Filter\FilterFactory;

function validateInput($string)
{
    $filter_factory = new FilterFactory();
    $apiFilter = $filter_factory->newValueFilter();
    $ok = $apiFilter->validate($string, 'alnum')
        && $apiFilter->validate($string, 'strlenBetween', 0, 8)
        && $apiFilter->sanitize($string, 'string');
    return($ok);
}

function loadInformation($fromArray)
{
    $json_field = [
        'attend_committee' => 1,
        'attend_unit' => 1,
        'case_title' => 1,
        'description' => 1,
        'resolution' => 1,
        'place' => 1,
        'reason' => 1,
        'suggest' => 1,
        'response' => 1,
        'adhoc' => 1
        ];
    $replace = [
        'origin' => 'raw_file',
        'note_code' => 'minute_id',
        'case_code' => 'case_id',
        'location' => 'place',
        'note_taker' => 'minute_taker',
        'attend_committee' => 'committee_attendance',
        'attend_unit' => 'other_attendace',
        'chairman' => 'chair'
        ];
    foreach($fromArray as $k => $value) {
        if(isset($json_field[$k])) $value = json_decode($value, JSON_UNESCAPED_UNICODE);
        if(isset($replace[$k])) $k = $replace[$k];
        $toArray[$k] = $value;
    }
    return $toArray;
}
