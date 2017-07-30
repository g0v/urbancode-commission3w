<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>都委會議記錄資料庫 | @yield('title')</title>
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @section('navibar')
<nav class="nav">
        <ul>
            <li><a href="{{ url('/') }}">首頁</a></li>
            <li>關於本站</li>
        </ul>
        </nav>
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
