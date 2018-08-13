@include('templates.header')
<?php
$province = \App\Province::findOrFail($_GET['province']);
$sports = \App\Sport::orderBy('name', 'ASC')->get();
?>
<div class="col-lg-10 col-lg-offset-1">
    <h2 class="text-center bold"><b>Member List - {{ $province->name}} </b></h2>
    <br/>


    @foreach ($sports as $sport)

            <?php $members = \App\Member::whereSport($sport->id)->whereProvince($province->id)->orderBy('firstname','ASC')->get(); ?>
            @if($members->count()>0)
            <table class="table table-striped table-bordered">
                <tr style="background: #333;">
                <td><b style="color: #fff">{{ $sport->name}}</b></td>
               </tr>
               <tr>
                <td width="30%"><b>Fullname</b></td>
                <td width="20%"><b>Sex</b></td>
                <td width="20%"><b>DOB</b></td>
                <td width="30%"><b>National ID</b></td>
               </tr>
                @foreach ($members as $member)
                    <tr>
                        <td>{{$member->firstname}} {{$member->surname}}</td>
                         <td>{{$member->gender}}</td>
                          <td>{{$member->dob}}</td>
                          <td>{{$member->national_id}}</td>
                         
                    </tr>

                    @endforeach
                    
                     <tr>
                <td><b></b></td>
                <td><b></b></td>
                <td><b>Total</b></td>
                <td><b>{{$members->count()}}</b></td>
               </tr>

            </table>
            @endif
    @endforeach


</div>
@include('templates.footer')
