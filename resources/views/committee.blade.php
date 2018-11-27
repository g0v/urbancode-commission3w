@extends('main')

@section('title', '委員會名單')

@section('content')
    <p>都市計畫委員會列表</p>
    <p>
        這個表的內容由社群完成。如果有連結失效或是更新，歡迎至
        <a href="https://g0v.hackmd.io/s/rymS3929X" target="blank">協作文件hackmd</a>
        編輯或到
        <a href="https://www.facebook.com/groups/470451239772824/permalink/1108667942617814/" target="blank">facebook討論串</a>
        留言!
    </p>

    @php
    $filename = storage_path('app\committee.csv');
    $file = fopen($filename, "r");
    $all_data = array();
    while ( ($data = fgetcsv($file, 200, ",")) !==FALSE)
    {
        $entry = array($data[0],$data[1],$data[2],$data[3]);
        array_push($all_data, $entry);
    }
    fclose($file);
    @endphp

    <table>
        <tr>
            <th>縣市</th>
            <th>委員會名單</th>
            <th>會議議程網址</th>
            <th>會議記錄網址</th>
        </tr>
        @foreach ($all_data as $data)
            <tr>
                <td class="text-center align-middle">{{ $data[0] }}</td>
                @for ($i=1; $i < 4; $i++)
                    @if ($data[$i]!="")
                        <td class="text-center align-middle">
                                <a href={{ $data[$i] }} target="blank">連結</a>
                        </td>
                    @else
                        <td></td>
                    @endif
                @endfor
            </tr>
        @endforeach
    </table>

@endsection
