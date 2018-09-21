<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Blessing Mashoko, Mashcom, Youth Games"/>
    <meta name="description" content="Youth Games Accreditation System designed and developed by Blessing Mashoko">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<style>
    @font-face {
        font-family: Eina;
        src: url({{asset('fonts/eina/eina-03-bold.woff2')}}) format("woff2"),
        url({{asset('fonts/eina/eina-03-bold.woff')}}) format("woff"),
        url({{asset('fonts/eina/eina-03-bold.ttf')}}) format("ttf"),
        url({{asset('fonts/eina/eina-03-boldd41d.eot?#iefix')}}) format("eot");
        font-weight: 700;
        unicode-range: U+000-5FF
    }

    @font-face {
        font-family: Eina;
        src: url({{asset('fonts/eina/eina-03-semibold.woff2')}}) format("woff2"),
        url({{asset('fonts/eina/eina-03-semibold.woff')}}) format("woff"),
        url({{asset('fonts/eina/eina-03-semibold.ttf')}}) format("ttf"),
        url({{asset('fonts/eina/eina-03-semiboldd41d.eot?#iefix')}}) format("eot");
        font-weight: 600;
        unicode-range: U+000-5FF
    }

    @font-face {
        font-family: Eina;
        src: url({{asset('fonts/eina/eina-03-regular.woff2')}}) format("woff2"),
        url({{asset('fonts/eina/eina-03-regular.woff')}}) format("woff"),
        url({{asset('fonts/eina/eina-03-regular.ttf')}}) format("ttf"),
        url({{asset('fonts/eina/eina-03-regulard41d.eot?#iefix')}}) format("eot");
        font-weight: 400;
        unicode-range: U+000-5FF
    }

    body {
        font-family: "eina", "segoe ui", "helvetica" !important;
    }
</style>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

            </div>
        </div>
    </nav>

    <main class="py-4">
       
        @yield('content')
    </main>
</div>
</body>
</html>
