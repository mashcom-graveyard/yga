@include('templates.header')

<div class="container">
    <h2 class="text-center"><b>Edit Member Details</b></h2>

    <div class="row justify-content-center">

        <div class="row col-lg-12">
            <h2 class="mb-3 text-center"></h2>
        </div>
        <div class="col-lg-2">
            <img id="blah" src="{{ asset("images/$member->image") }}" alt="member image" style="width: 100%" />
        </div>
        <div class="col-md-10 well">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{  session('success') }}
                </div>
            @endif
            <form class="needs-validation form-horizontal" method="post" action='{{ url("member/update/$member->id") }}' enctype="multipart/form-data">

                {{ csrf_field()  }}


                <div class="row">

                    <br/><br/>
                   

                    <div class="col-md-4 mb-3">
                        <label for="firstName">Firstname</label>
                        <input class="form-control" name="firstname" value="{{ $member->firstname }}"
                               placeholder="Firstname"
                               value="" required=""
                               type="text">

                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Surname</label>
                        <input class="form-control" name="surname" placeholder="Surname"
                               value="{{ $member->surname }}" required=""
                               type="text">

                    </div>

                     <div class="col-md-4 mb-3" style="display: nodne !important;">
                             <label for="firstName">Date of Birth</label>
                             <div style="width: 100% !important;">
                              <select name="day" id="adobday" class="form-control" style="width: 32% !important;float: left !important;"></select>
                              <select name="month" id="adobmonth" class="form-control" style="width: 32% !important;float: left !important;"></select>
                            <select name="year" id="adobyear" class="form-control" style="width: 32% !important;float: left !important;"></select>
                        </div>
                        </div>

                    <div class="col-md-4 mb-3">
                        <br/>
                        <label for="firstName">Gender</label>
                        <select class="form-control" name="gender"
                                required=""
                        >
                            <option></option>
                            <option <?php if ($member->gender == 'Male') {
                                echo "selected";
                            } ?>>Male
                            </option>
                            <option <?php if ($member->gender == 'Female') {
                                echo "selected";
                            } ?>>Female
                            </option>
                        </select>

                    </div>

                    <div class="col-md-4 mb-3">
                             <br/>
                        <label for="firstName">National ID <label class="label label-success">Format 67-2001643-H-09</label></label>
                        <input class="form-control" name="national_id" placeholder="National ID Number"
                               value="{{ $member->national_id }}" required=""
                               type="text">

                    </div>


                    <div class="col-md-4 mb-3">
                        <br/>
                        <label for="firstName">Select ID Photo</label>
                        <input type="file" src="" alt="" name="image" onchange="readURL(this);">

                    </div>
                </div>


                <div class="row">

                    <br/><br/>
                     <div class="col-md-4 mb-3">
                        <label for="firstName">Province</label>
                        <select class="form-control" id="firstName" name="province"
                                value="" required=""
                                type="text" readonly>

                            @foreach($provinces as $province)
                                    @if(\Illuminate\Support\Facades\Auth::user()->province_id == $province->id )
                                        <option value="{{ $province->id }}" selected>{{$province->name}}</option>
                                    @endif
                                @endforeach


                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="firstName">Designation</label>
                        <select class="form-control" name="designation">
                            @foreach($designation as $d)
                                <option value="{{  $d->id }}" <?php if ($d->id == $member->designation) {
                                    echo "selected";
                                } ?> >{{ $d->name }}</option>
                            @endforeach
                        </select>

                    </div>

                     <div class="col-md-4 mb-3">
                        <label for="firstName">Sport</label>
                        <select class="form-control" id="firstName" name="sport"
                                value="" required=""
                                type="text">
                            <option></option>

                            @foreach($sports as $sport)
                                <option value="{{ $sport->id }}"  <?php  if($member->member_sport->id==$sport->id) { echo "selected";} ?>>{{$sport->name}}</option>
                            @endforeach


                        </select>

                    </div>


                    
                </div>

                <div class="row">
                    <br/><br/>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Address</label>
                        <textarea class="form-control" rows="5" name="address" required="">{{ $member->address }}
                        </textarea>

                    </div>
                    <div class="col-lg-8">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Telephone <label class="label label-success">optional</label></label>
                            <input class="form-control" name="telephone"
                                   value="{{ $member->telephone }}"
                                   type="text">

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="firstName">Email <label class="label label-success">optional</label></label>
                            <input class="form-control" name="email"
                                   value="{{ $member->email }}"
                                   type="email">

                        </div>

                        <div class="col-md-6 mb-3">
                            <br/>
                            <label for="firstName">Mobile</label>
                            <input class="form-control" name="mobile"
                                   value="{{ $member->mobile }}"
                                   type="text">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <br/><br/>
                  

                   
                    

                </div>

                <div class="row">
                    <br/>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary btn-lg" value="Save">
                    </div>
                </div>
            </form>
        </div>


    </div>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>



<script src="{{ asset('js/dobPicker.min.js')}}"></script>
<?php 
  $full_dob = explode("-",$member->dob);
  
  $js_year = $full_dob[0];
  $js_month = $full_dob[1];
  $js_day = $full_dob[2];
  ?>

<script type="text/javascript">

    $(document).ready(function(){
        $.dobPicker({
            // Selectopr IDs
daySelector: '#adobday',
monthSelector: '#adobmonth',
yearSelector: '#adobyear',

// Default option values
dayDefault: '<?php echo $js_day; ?>',
monthDefault: '<?php echo $js_month; ?>',
yearDefault: '<?php echo $js_year; ?>',

// Minimum age
minimumAge: 5,

// Maximum age
maximumAge: 100
        });
    });
 </script>

@include('templates.footer')