<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script> window.Larevel={csrfToken:'{{ csrf_token() }}'}</script>

        <title>API-VUE</title>

        <link rel="stylesheet" href="{{ URL::asset('bootstrap\css\bootstrap.min.css') }}">
    </head>
    <body>
    <div id="app">
    <navbar></navbar>
        <div class="container">
            <articles></articles>
        </div>
    </div>
        

<script type="text/javascript" src="{{ URL::asset('bootstrap\js\jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap\js\bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/app.js')}}"></script>
</body>
</html>
