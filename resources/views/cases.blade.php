<!DOCTYPE html>
@php
    $url = $_SERVER['HTTP_HOST'].'/api'.$_SERVER['REQUEST_URI'];
    $query = file_get_contents('http://'.$url);
    $queryArray = json_decode($query, JSON_UNESCAPED_UNICODE);

    $queryArray['case_title'] = implode('', $queryArray['case_title']);

    $caseType = ['0', '報告事項', '確認事項', '審議事項', '討論事項', '臨時動議'];

    $queryArray['type'] = $caseType[$queryArray['type']];

    $listArray = ['description',
                    'committee_speak',
                    'response',
                    'adhoc',
                    'resolution',
                    'add_resolution',
                    'attached',
                    'petitions'
                ];

    $infoSequence = ['案件id' => 'case_id',
                    '概要說明' => 'description',
                    '委員發言' => 'committee_speak',
                    '專案小組意見' => 'adhoc',
                    '業務單位回應' => 'response',
                    '決議' => 'resolution',
                    '附帶決議' => 'add_resolution',
                    '附件' => 'attached',
                    '人民陳情案件' => 'petitions'
                    ];

    $petitionList = ['reason',
                    'suggest',
                    'response',
                    'adhoc',
                    'resolution'];

    $petitionSequence = ['陳情案名' => 'petition_case',
                        '陳情編號' => 'petition_num',
                        '陳情人' => 'name',
                        '陳情地點' => 'place',
                        '陳情理由' => 'reason',
                        '建議辦法' => 'suggest',
                        '業務單位回覆' => 'response',
                        '專案小組意見' => 'adhoc',
                        '決議' => 'resolution'];
@endphp
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>[都委會議記錄資料庫]-{{ $queryArray['minute_id'].'-'.$queryArray['case_title'] }}</title>
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    </head>
    <body>
        <p><h1>{{ $queryArray['minute_id'].'-'.$queryArray['type'].'-'.$queryArray['case_title'] }}</h2></p>
        @foreach ($infoSequence as $k => $value)
            @if (isset($queryArray["$value"]))
                <p><span class="heading">{{ $k }}：</span>
                @if (!in_array($value, $listArray))
                {{ $queryArray["$value"] }}
                @elseif ($value == 'petitions')
                    @foreach ($queryArray["$value"] as $petition)

                    <div class="petition-list">
                        @foreach ($petitionSequence as $petitionKey => $petitionValue)
                            @if (isset($petition["$petitionValue"]))
                                <p><span class="petition-heading">{{ $petitionKey }}：</span>
                                    @if (!in_array($petitionValue, $petitionList))
                                    {{ $petition["$petitionValue"] }}
                                    @else
                                        <ul>
                                            @foreach ($petition["$petitionValue"] as $petitionLive)
                                                <li>{!! preg_replace('/\\\r\\\n/', '<br>', $petitionLive) !!}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </p>
                            @endif
                        @endforeach
                    </div>

                    @endforeach
                @else
                    <ul>
                        @foreach ($queryArray["$value"] as $valueLine)
                            <li>{!! preg_replace('/\\\r\\\n/', '<br>', $valueLine) !!}</li>
                        @endforeach
                    </ul>
                @endif
                </p>
            @endif
        @endforeach
    </body>
</html>
