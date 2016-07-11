<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tasks</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div style="text-align: right; margin-right: 20px;">
                    @if (Auth::user())
                    <span>Hi, {{Auth::User()->first_name}}</span>
                    <br/>
                    <a href="{{url('auth/logout')}}">Logout</a>
                    @endif
                </div>
            </nav>
        </div>

        @yield('content')

        <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>