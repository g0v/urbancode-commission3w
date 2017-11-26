@php
    use App\Notes as Notes;
    use App\Webapps as Webapps;

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

    $noteList = Notes::where('admin', 'LIKE', $target.'%')
                        ->select('note_code', 'title', 'date')
                        ->orderBy('session', 'round', 'desc')
                        ->get();
@endphp

@extends('main')

@section('title', $placeList["$target"])

@section('content')
<ul>
    @foreach ($noteList as $note)
    @if (!empty($note['title']))
        <li><a href="{{ Webapps\noteCode2URL($note['note_code']) }}" target="_blank">[{{ $note['date'] }}] {{ $note['title'] }}</a></li>
    @endif
    @endforeach
</ul>
@endsection
