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
    $replace = [
        'origin' => 'raw_file',
        'note_code' => 'minute_id',
        'location' => 'place',
        'note_taker' => 'minute_taker',
        'attend_committee' => 'committee_attendance',
        'attend_unit' => 'other_attendace',
        'chairman' => 'chair'
        ];
    foreach($fromArray as $k => $value) {
        if(isset($replace[$k])) $k = $replace[$k];
        $toArray[$k] = $value;
    }
    return $toArray;
}
