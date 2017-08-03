@php
    use App\Webapps as Webapps;

    $url = $_SERVER['HTTP_HOST'].'/api'.$_SERVER['REQUEST_URI'];
    $query = file_get_contents('http://'.$url);
    $queryArray = json_decode($query, JSON_UNESCAPED_UNICODE);
    $caseList = $queryArray['cases'];
@endphp

@extends('main')

@section('title', '搜尋:'.$queryArray['query'])

@section('content')
    <ul>
    @foreach ($caseList as $case)
        @php
            $caseTitle = json_decode($case['case_title'], JSON_UNESCAPED_UNICODE);
            if(isset($caseTitle)) {
                $caseTitle = implode('', $caseTitle);
            } else {
                continue;
            }

            $minute_url = Webapps\noteCode2URL($case['note_code']);
            $caseType = Webapps\caseType2Name($case['type']);
        @endphp
        <li><a href="minutes/{{ $minute_url }}/cases/{{ $case['case_code'] }}">{{ '['.$caseType.'] '.$caseTitle }}</a></li>
    @endforeach
    <ul>
@endsection
