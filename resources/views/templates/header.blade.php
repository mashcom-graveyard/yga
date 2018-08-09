<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="TMS">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Youth Games Accreditation</title>
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>-->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
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
                    <li><a href="{{ url('rules') }}">Allocations</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">System Parameters <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('sport') }}">Sport Codes</a></li>
                            <li><a href="{{ url('province') }}">Provinces</a></li>
                            <li><a href="{{ url('venue') }}">Venues/Villages</a></li>
                            <li><a href="{{ url('designation') }}">Designations</a></li>
                            <li><a href="{{ url('zone') }}">Access Zones</a></li>
                            <li><a href="{{ url('category') }}">Categories</a></li>


                        </ul>
                    </li>
                    <li><a href="{{ url('report') }}">Report</a></li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->access_level==3)
                    <li><a href="{{ url('users') }}">Users</a></li>
                @endif
                <li><a href="https://drive.google.com/file/d/1IEB8LVSmvGWmjDe1ZDJcVCLooXDgMM5t/view?usp=sharing" target="_blank">User Manual</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->name }} <span
                                class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/security/password') }}">Change Password</a></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </li>

            <!--<li><a>Logged as:{{ \Illuminate\Support\Facades\Auth::user()->name }}</a></li>!-->
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
