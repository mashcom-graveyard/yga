@include('templates.header')

<div class="container">
    <h2 class="text-center"><b>Dashboard
            

            @if(\Illuminate\Support\Facades\Auth::user()->access_level ==2)
                - {{ \Illuminate\Support\Facades\Auth::user()->user_province->name }} Province
            @endif</b>
        @if(\Illuminate\Support\Facades\Auth::user()->access_level ==3)
            - {{ \Illuminate\Support\Facades\Auth::user()->user_province->name }} Province <label
                    class="label label-success"> General Manager</label>
            @endif</b>
    </h2>
    <h5 class="text-center"><b>Get a quick overview of all records</b></h5>
    <br/><br/>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center"><b>Registered Members</b></div>
            <div class="panel-body"><h1 class="text-center"><b>{{ $member_count }}</b></h1></div>
            <div class="panel-footer text-center"><a href="{{url('/member')}}"><b>View</b></a></div>
        </div>
    </div>


    @if(\Illuminate\Support\Facades\Auth::user()->access_level ==1)
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Provinces</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{ $province_count }}</b></h1></div>
                <div class="panel-footer text-center"><a href="{{url('/province')}}"><b>View</b></a></div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Designations</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{ $designation_count }}</b></h1></div>
                <div class="panel-footer text-center"><a href="{{url('/designation')}}"><b>View</b></a></div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Venues</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{ $venue_count }}</b></h1></div>
                <div class="panel-footer text-center"><a href="{{url('/venue')}}"><b>View</b></a></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Sports</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{ $sport_count }}</b></h1></div>
                <div class="panel-footer text-center"><a href="{{url('/sport')}}"><b>View</b></a></div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Game Venue/Village Allocations</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{ $allocations_count }}</b></h1></div>
                <div class="panel-footer text-center"><a href="{{url('/rules')}}"><b>View</b></a></div>
            </div>
        </div>


    @endif

</div>


@include('templates.footer')