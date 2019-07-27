@include('templates.header')
<?php
$provinces = \App\Province::with('province_members')->get();
$sports = \App\Sport::orderBy('name', 'ASC')->get();
?>
<div class="col-lg-10 col-lg-offset-1">
    <h2 class="text-center bold"><b>Printing Dashboard</b></h2>
    <h5 class="text-center bold"><b>NB* Only Sport Codes with members are shown</b>
    <br/>

    <?php $r_index =0 ?>
    @foreach ($provinces as $province)
          <?php $province_count = \App\Member::whereProvince($province->id)->count(); ?>
              @if($province_count>0)  
        <div class="col-lg-12">   
            <table class="table table-striped table-bordered">
                <tr style="background: #222">
                    <td style="color: #fff"><b>{{$province->name}}</b></td>
                </tr>
                <tr>
                @foreach ($sports as $sport)
                    <?php $count = \App\Member::whereProvince($province->id)->whereSport($sport->id)->count(); ?>
              @if($count>0)      
              <tr>
                        <td width="40%">{{$sport->name}}</td>
                        <td width="20%"><b>{{ $count }}</b></td>
                        <td>
                            @if($count>0)
                                <a href='{{ url("/print/cards/$province->id/$sport->id") }}' class="btn btn-primary btn-xs  inline pull-left"><b>Print Cards</b></a>
                                @if(Storage::disk('public')->exists("$province->name/$sport->name.pdf" ))
                                <a href='{{url("/download/$province->name/$sport->name/$province->id/$sport->id")}}' class="btn btn-xs btn-success btn-inline  inline pull-left" style="margin-left: 5% !important;"><b>Download Cards</b></a>
                                @endif
                                <a href='{{ url("/refresh/card/$province->id/$sport->id") }}' class="btn btn-warning btn-xs  inline pull-left" style="margin-left: 5% !important;"><b>Add to Buffer</b></a>
                               
                            @endif
                        </td>
                    </tr>
               @endif
                    

                    @endforeach
                    </tr>

            </table>
        </div>
    @endif
  
    @endforeach


</div>
@include('templates.footer')
