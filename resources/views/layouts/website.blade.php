<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/website.css') }}" rel="stylesheet">
    @include('auth.data-user')
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    <div id="wrapper">
        <div id="app">
            @include('layouts.web-ly.header')
            @yield('content')
            @include('layouts.web-ly.footer')
        </div>
    </div>
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <script src="{{ asset('js/website.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
