<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Social</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href=https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css rel=stylesheet>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel=stylesheet type=text/css>
        <link href="{{ asset('css/nucleo-icons.css') }}" rel=stylesheet>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        @if(Auth::check())
            window.Laravel.Auth = {!! json_encode( Auth::user() ) !!};
            
        @endif
    </script>
    </head>
    <body>
        <div id="root"></div>
    </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
