<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        @php
            $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $output = file_get_contents('http://'.$url);
        @endphp
        {{ $url }}<br>
        admin: {{ $admin }}<br>
        period: {{ $period }}<br>
        session: {{ $session }}<br>
        round: {{ $round }}
    </body>
</html>
