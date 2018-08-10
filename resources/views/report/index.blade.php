@include('templates.header')
<?php
$provinces = \App\Province::with('province_members')->get();
$sports = \App\Sport::orderBy('name', 'ASC')->get();
?>
<div class="col-lg-10 col-lg-offset-1">
    <h2 class="text-center bold"><b>Quick Report</b></h2>
    <h5 class="text-center bold"><b>Get a quick count of members of different sports in different provinces</b></h5>
    <br/>

    <?php $r_index =0 ?>
    @foreach ($provinces as $province)
            <?php $r_index+=1; ?>
            @if($r_index%3==0)
            <div class="row">
                @endif
        <div class="col-lg-4">
            <h3><b>{{$province->name}}</b></h3>
            <table class="table table-striped table-bordered">
                <tr>
                @foreach ($sports as $sport)
                    <tr>
                        <td>{{$sport->name}}</td>
                        <td><b>{{\App\Member::whereProvince($province->id)->whereSport($sport->id)->count()}}</b></td>
                        <td><a href='{{ url("/print/cards/$province->id/$sport->id") }}' class="btn btn-primary btn-xs  inline pull-left"><b>Print Cards</b></a>
                            @if(Storage::disk('public')->exists("$province->name/$sport->name.pdf" ))
                            <a href='{{url("/download/$province->name/$sport->name/$province->id/$sport->id")}}' class="btn btn-xs btn-success btn-inline  inline pull-left"><b>Download Cards</b></a>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                    </tr>

            </table>
        </div>
        @if($r_index%3==0)
    </div>
    @endif
    @endforeach


</div>
@include('templates.footer')
