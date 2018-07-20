<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Card</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz');

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

        * {
            font-weight: bold !important;
        }

        body {
            font-family: "eina", "segoe ui", "helvetica" !important;

        }

        .id-card {
            background-color: #fafafa; /*#e13930;*/
            padding-top: 6px;
            height: 600px;
            color: #444;

        }

        @media print {
            .id-card {
                background-color: #fafafa; /*#e13930;*/
                padding-top: 6px;
                height: 600px;
                color: #444;
                width: 800px;

            }
        }


    </style>
</head>
<body>
<div class="col-lg-4 col-lg-offset-2 id-card">


    <div class="col-lg-3" style="overflow: hidden">
        <img src="{{ asset('logo.jpg') }}" alt="" style="width: 90px;">
    </div>
    <div class="col-lg-6 text-center">
        <h5>Enhancing peace, love, unity, Podium Perfomance and Economic Development through sport</h5>
    </div>
    <div class="col-lg-3" style="overflow: hidden">
        <img src="{{ asset('download.jpg') }}" alt="" style="width: 90px;">
    </div>

    <div class="row col-lg-12">
        <h3 class="text-center text-uppercase">{{ $member->member_designation->name }}</h3>
    </div>
    <div class="col-lg-4" style="overflow: hidden">
        <img src="{{ asset('/images/'.$member->image) }}" alt="" style="max-width: 100%;">
    </div>

    <div class="col-lg-8">

        <b>
            <h5>Name: {{ $member->firstname." ".$member->surname }}</h5>
            <h5>DOB: {{ $member->dob }}</h5>
            <h5>ID No: {{ $member->national_id }}</h5>
            <h5>Sex: {{ $member->gender }}</h5>
        </b>

        @if ($member->member_designation->name == "Athlete")
            <h4>Sport: {{ $member->member_sport->name }}</h4>

        @endif


        <?php
        $catering_code = "C1";
        if ($member->member_designation->name == "VIP") {
            $catering_code = "C2";
        }
        $transport_code = "T1 T2 T3";
        if ($member->member_designation->name == "Athlete") {
            $transport_code = "T1 T2";
        }
        ?>
        <h3>CATERING</h3>
        <h4>{{ $catering_code }}</h4>
        <h3>TRANSPORT</h3>
        <h4>{{ $transport_code }}</h4>
        <?php

        $member_json_data = json_encode(["id" => $member->id]);
        QRCode::text($member_json_data)->svg();
        ?>
        </b>
    </div>
</div>

<div class="col-lg-4 id-card">


    <div class="col-lg-3" style="overflow: hidden">
        <img src="{{ asset('logo.jpg') }}" alt="" style="width: 90px;">
    </div>
    <div class="col-lg-6 text-center">
        <h5>Enhancing peace, love, unity, Podium Perfomance and Economic Development through sport</h5>
    </div>
    <div class="col-lg-3" style="overflow: hidden">
        <img src="{{ asset('download.jpg') }}" alt="" style="width: 90px;">
    </div>


    <div class="col-lg-12">
        <br/><br/>
        <ul>
            <li>This Accreditation Pass is personal, non-transfereable, must be displayed at all times while in the area
                requiring accreditation and is valid only in the areas indicated on this card
            </li>

        </ul>

        <?php

        $member_json_data = json_encode(["id" => $member->id]);
        QRCode::text($member_json_data)->svg();
        ?>
        </b>
    </div>
</div>

</body>
</html>

