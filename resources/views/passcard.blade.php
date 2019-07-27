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
        @import url('https://fonts.googleapis.com/css?family=Exo+2:400,700');
        @import url('https://fonts.googleapis.com/css?family=Nunito');

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
            font-family: "Exo 2", "nunito", " eina ", " segoe ui ", " helvetica " !important;

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
                padding: 6px;

            }

            #backcover {
                background-image: url('{{asset('bg_front.jpg')}}') !important;
                margin-top: 0;
                color: #fff !important;

            }

            #backcover * {
                color: #fff !important;
            }

            .access-label {
                background: #17a2b8 !important;
                color: #fff !important;
                font-weight: bold !important;
                border: none !important;
                font-size: 20px;
            }

            .page-break {
                overflow: hidden;
                page-break-after: always;
            }

            .red-bg {
                background: #e40203 !important;
                color: #fff !important;
            }
        }


    </style>
</head>
<body>

<?php $index = 0; ?>
@foreach($members as $member)

    <div <?php if ($index % 2) {
        echo "class='page-break'";
    } ?>>
        <table>
            <tr>
                <td width="45%">
                    <table width="100%" id="font-cover">
                        <tr>
                            <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('logo.jpg') }}" alt="" style="width: 90px;">
                            </td>
                            <td class="col-lg-6 text-center">
                                <h5>Zimbabwe National Youth and Paralympic Games Midlands</h5>
                                <h5>27 July- 10 August 2019</h5>
                            </td>
                            <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('download.jpg') }}" alt="" style="width: 90px;">
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr class="red-bg">
                            <td class="row red-bg">
                                <h3 class="text-center text-uppercase red-bg">{{ $member->member_designation->name }}</h3>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td class="col-lg-4" style="overflow: hidden">

                                @if(!empty($member->image))
                                    <img src="{{ asset('/images/'.$member->image) }}" alt=""
                                         style="width:200px;height: auto">
                                @else
                                    <img src="{{ asset('/no-image.jpg') }}" alt=""
                                         style="width:200px;height: auto">
                                @endif

                                <br/>
                                <h3>{{ $member->firstname." ".$member->surname }}</h3>
                                <?php

                                $member_json_data = json_encode(["id" => $member->id]);
                                QRCode::text($member_json_data)->svg();
                                ?>

                            </td>
                            <td class="col-lg-6">


                                <h5>Name: {{ $member->firstname." ".$member->surname }}</h5>
                                <h5>Province: {{ $member->member_province->name }}</h5>

                                @if ($member->member_designation->name == "Athlete")
                                    <h5>DOB: {{ date_format(date_create_from_format('Y-m-d', $member->dob ), 'd-m-Y')}}</h5>
                                @endif

                                <h5>ID No: {{ $member->national_id }}</h5>


                                <h5>Sex: {{ $member->gender }}</h5>

                                @if ($member->member_designation->name == "Athlete")

                                    <h3>Sport: {{ $member->member_sport->name }}</h3>



                                @endif


                                <?php

                                $codes = explode(',', $member->member_designation->zone_access);
                                $access_zones = $codes;
                                ?>
                                <h3>ZONE ACCESS</h3>

                                <h4>
                                    @foreach($access_zones as $access_zone)
                                        <label class="label label-success access-label">{{ $access_zone}}</label>
                                    @endforeach
                                </h4>


                            </td>
                        </tr>


                    </table>
                    <table width="100%">
                        <tr>
                             <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('SRC-LATEST.jpg') }}" alt="" style="width: 90px;">
                            </td>
                            <td class="col-lg-6 text-center text-italic">
                                <h6>Enhancing peace, love, unity, Podium Perfomance and Economic Development through
                                    sport</h6>
                                <br/><br/>
                            </td>
                            <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('ZNYG logo.PNG') }}" alt="" style="width: 90px;">
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="45%"
                    style="background-image: url('{{asset('card_bg.jpg')}}') !important;padding: 6px !important;color: #fff !important;"
                    id="backcover">
                    <table width="100%">
                        <tr>
                            <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('SRC-LATEST.jpg') }}" alt="" style="width: 90px;">
                            </td>
                            <td class="col-lg-6 text-center">
                                <h6>Zimbabwe National Youth and Paralympic Games Midlands</h6>
                                <h6>27 July- 10 August 2019</h6>
                            </td>
                            <td class="col-lg-3" style="overflow: hidden">
                                <img src="{{ asset('ZNYG logo.PNG') }}" alt="" style="width: 90px;">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td width="100%"><br/></td>
                        </tr>
                        
                        <tr>
                            <td width="100%" class="col-lg-10 col-lg-offset-1"><h3>IMPORTANT NUMBERS</h3></td>
                        </tr>
                        <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">CEO-0712365272  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; Technical-0773740640</td>
                        </tr>
                        <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">Security-0716800173 &nbsp; &nbsp; &nbsp; Logistics-0773375471</td>
                        </tr>
                        <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">GM-0772770212 &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Operations-0773028400</td>
                        </tr>
                        <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">Medical-0775701614 &nbsp; &nbsp; &nbsp; Secretariat-0773747556</td>
                        </tr>
                      <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">Catering-0779120743 &nbsp; &nbsp; &nbsp; Finance-0773742735</td>
                        </tr>
                       <tr>
                            <td width="95%" class="col-lg-10 col-lg-offset-1">Accreditation-0772716896 &nbsp; &nbsp; &nbsp; Accommodation-0712564729</td>
                        </tr>
                        <tr>
                            <td width="45%" class="col-lg-10 col-lg-offset-1"><h3>ZONE CODES</h3></td>
                        </tr>
                        @foreach($designation_zones as $dzone)
                            <tr>

                                <td width="100%" class="col-lg-10 col-lg-offset-1">ZONE ACCESS {{$dzone->id}}
                                    : {{strtoupper($dzone->name)}}</td>
                            </tr>
                        @endforeach
                    </table>
                   
                    <table width="100%">
                        <tr>

                            <td class="col-lg-12 text-center text-italic">
                                <h6>Enhancing peace, love, unity, Podium Perfomance and Economic Development through
                                    sport</h6>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr/>
    </div>
    <?php $index++ ?>
@endforeach

</body>
</html>

