@php
    $placeList = ['MOI' => '內政部',
                    'TPE' => '臺北市',
                    'TAO' => '桃園市',
                    'NWT' => '新北市',
                    'TXG' => '臺中市',
                    'TNN' => '臺南市',
                    'KHH' => '高雄市',
                    'KEE' => '基隆市',
                    'HSZ' => '新竹市',
                    'HSQ' => '新竹縣',
                    'MIA' => '苗栗縣',
                    'CHA' => '彰化縣',
                    'NAN' => '南投縣',
                    'YUN' => '雲林縣',
                    'CYI' => '嘉義市',
                    'CYQ' => '嘉義縣',
                    'PIF' => '屏東縣',
                    'ILA' => '宜蘭縣',
                    'HUA' => '花蓮縣',
                    'TTT' => '臺東縣',
                    'KIN' => '金門縣',
                    'LIE' => '連江縣',
                    'PEN' => '澎湖縣'];

@endphp

@extends('main')

@section('title', '首頁')

@section('content')
    <div class="place-list">
    <ul>
    @foreach ($placeList as $placeKey => $place)
        <li><a href="/{{ $placeKey }}">{{ $place }}</a></li>
    @endforeach
    </ul>
    </div>
@endsection
