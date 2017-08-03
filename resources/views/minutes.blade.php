@php
    $url = $_SERVER['HTTP_HOST'].'/api'.$_SERVER['REQUEST_URI'];
    $query = file_get_contents('http://'.$url);
    $queryArray = json_decode($query, JSON_UNESCAPED_UNICODE);

    $queryArray['committee_attendance'] = implode('', $queryArray['committee_attendance']);
    $queryArray['other_attendace'] = implode('', $queryArray['other_attendace']);

    $caseList = $queryArray['cases'];

    $infoSequence = ['日期' => 'date',
                    '時間' => 'start_time',
                    '地點' => 'place',
                    '主席' => 'chair',
                    '紀錄彙整' => 'minute_taker',
                    '出席委員' => 'committee_attendance',
                    '出席單位' => 'other_attendace'
                    ];
@endphp

@extends('main')

@section('title', $queryArray['title'])

@section('content')
        <p><h1>{{ $queryArray['title'] }}</h1></p>

        @foreach ($infoSequence as $k => $value)
            <p><span class="heading">{{ $k }}：</span>{{ $queryArray["$value"] }}</p>
        @endforeach

        <p><span class="heading">案件：</span></p>
        <ol>

        @foreach ($caseList as $case)
            @php
                $url = preg_replace("/\/api/", '', $case['url']);
            @endphp
            <li><a target="_blank" href="http://{{ $url }}">{{ $case['case_title'] }}</a></li>
        @endforeach

        </ol>
@endsection
