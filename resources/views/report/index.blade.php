@include('templates.header')
<?php
$provinces = \App\Province::with('province_members')->get();
$sports = \App\Sport::orderBy('name', 'ASC')->get();
?>
<div class="col-lg-10 col-lg-offset-1">
    <h2 class="text-center bold"><b>Quick Report</b></h2>
    <h5 class="text-center bold"><b>Get a quick count of members of different sports in different provinces</b></h5>
    <br/>


    @foreach ($provinces as $province)
        <div class="col-lg-4">
            <h3><b>{{$province->name}}</b></h3>
            <table class="table table-striped table-bordered">
                <tr>
                @foreach ($sports as $sport)
                    <tr>
                        <td>{{$sport->name}}</td>
                        <td><b>{{\App\Member::whereProvince($province->id)->whereSport($sport->id)->count()}}</b></td>
                        <td><a href='{{ url("/print/cards/$province->id/$sport->id") }}' class="btn btn-primary btn-xs">Print Cards</a></td>
                    </tr>

                    @endforeach
                    </tr>

            </table>
        </div>
    @endforeach


</div>
@include('templates.footer')
