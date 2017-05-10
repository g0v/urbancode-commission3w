<?php
namespace App\minuteContent;

class minute
{
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
}
