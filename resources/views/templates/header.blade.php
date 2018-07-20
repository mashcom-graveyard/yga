<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="TMS">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Youth Games Accreditation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
    <!-- Styles -->

</head>
<body class="bg-light">
<nav class="navbar navbar-default" ng-controller="AppCtrl">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/dashboard') }}">YGA System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('member') }}">Members</a>
                </li>
                <li><a href="{{ url('member/create') }}">New Member</a></li>
                @if(\Illuminate\Support\Facades\Auth::user()->access_level==1)
                    <li><a href="{{ url('users') }}">Users</a></li>
                    <li><a href="{{ url('sport') }}">Sports</a></li>
                    <li><a href="{{ url('province') }}">Provinces</a></li>
                    <li><a href="{{ url('venue') }}">Venues</a></li>
                    <li><a href="{{ url('designation') }}">Designations</a></li>
                    <li><a href="{{ url('rules') }}">Allocations</a></li>
                    <li><a href="{{ url('category') }}">Categories</a></li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->access_level==3)
                    <li><a href="{{ url('users') }}">Users</a></li>
                @endif


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('logout') }}">Logout</a></li>
            <!--<li><a>Logged as:{{ \Illuminate\Support\Facades\Auth::user()->name }}</a></li>!-->
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
