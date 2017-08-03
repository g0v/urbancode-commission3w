<?php

namespace App\Webapps;

function noteCode2URL($noteCode)
{
    $admin = substr($noteCode, 0, 3);
    $period = substr($noteCode, 3, 1);
    $session = substr($noteCode, 4, 3);
    $round = substr($noteCode, 7, 1);
    $noteCodeURL = $admin.'-'.$period.'-'.$session.'-'.$round;
    return ($noteCodeURL);
}

function caseType2Name($case_type)
{
    $TypeArray = ['0', '報告事項', '確認事項', '審議事項', '討論事項', '臨時動議'];

    return($TypeArray["$case_type"]);
}
