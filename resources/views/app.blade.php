<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="csrf-token" content=" {{ csrf_token() }} ">
        <title>Laravel app</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>

        <div id="app"></div>
        <script src="{{ asset('js/vue.js') }}"></script>
    </body>
</html>
