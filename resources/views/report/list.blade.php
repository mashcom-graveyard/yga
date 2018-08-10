@include('templates.header')
<?php
$members = \App\Province::with('province_members')->get();
$sports = \App\Sport::orderBy('name', 'ASC')->get();
?>
<div class="col-lg-10 col-lg-offset-1">
    <h2 class="text-center bold"><b>Quick Report</b></h2>
    <h5 class="text-center bold"><b>Get a quick count of members of different sports in different provinces</b></h5>
    <br/>


    @foreach ($sports as $sport)
            <?php $members = \App\Member::whereSport($sport->id)->get(); ?>
            <h3><b>{{$sport->name}}</b></h3>
            <table class="table table-striped table-bordered">
               
                @foreach ($members as $member)
                    <tr>
                        <td>{{$member->firstname}} {{$member->surname}}</td>
                          <td><b>{{$member->national_id}}</b></td>
                          <td><b>{{$member->dob}}</b></td>
                    </tr>

                    @endforeach
                    

            </table>
    @endforeach


</div>
@include('templates.footer')
