<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>都委會議記錄資料庫 | @yield('title')</title>
        <meta charset="utf-8">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- custom CSS -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @section('navibar')
            <nav class="navbar navbar-expand navbar-light bg-light fixed-top">
                <div class="container">
                <a class="navbar-brand" href="#">都市計畫委員會資料庫</a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">首頁</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">關於本站</a></li>
                </ul>
            </div>
            </nav>
        @show

        <div class="container">
            @yield('content')
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('js/bootstrap.min.js') }}"
    </body>
</html>
