@include('templates.header')

<div class="container">
    <h2 class="text-center"><b>Capture Member Details</b></h2>

    <div class="row justify-content-center">

        <div class="row col-lg-12">
            <h2 class="mb-3 text-center"></h2>
        </div>

        <div class="col-lg-2">
            <img id="blah" src="#" alt="your image" />
        </div>
        <div class="col-lg-10 well bs-component">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="needs-validation form-horizontal" method="post" action="{{ url('/member') }}"
                  enctype="multipart/form-data">
                <fieldset>
                    {{ csrf_field()  }}


                    <div class="row">

                        <br/><br/>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Firstname</label>
                            <input class="form-control" name="firstname" value="{{ old('firstname') }}"
                                   placeholder="Firstname"
                                   value="" required="" autofocus
                                   type="text">

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Surname</label>
                            <input class="form-control" name="surname" placeholder="Surname"
                                   value="{{ old('surname') }}" required=""
                                   type="text">

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Date of Birth <label class="label label-success">Format dd/mm/yyyy</label></label>
                            <input class="form-control" name="dob" placeholder="dd-mm-yyyy"
                                   value="{{ old('dob') }}"
                                   type="date">

                        </div>

                        <div class="col-md-4 mb-3">
                            <br/>
                            <label for="firstName">Gender</label>
                            <select class="form-control" name="gender"
                                    value="" required=""
                                    type="text">
                                <option></option>
                                <option {{ old('gender') == "Male" ? 'selected' : '' }}>Male</option>
                                <option {{ old('gender') == "Female" ? 'selected' : '' }}>Female</option>
                            </select>

                        </div>
                        <div class="col-md-4 mb-3">
                            <br/>
                            <label for="firstName">National ID <label class="label label-success">Format 67-2001643-H-09</label></label>
                            <input class="form-control" name="national_id" placeholder="National ID Number"
                                   value="{{ old('national_id') }}"
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
                                    type="text" readonly="">
                                @foreach($provinces as $province)
                                    @if(\Illuminate\Support\Facades\Auth::user()->province_id == $province->id )
                                        <option value="{{ $province->id }}">{{$province->name}}</option>
                                    @endif
                                @endforeach


                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Designation</label>

                            <select class="form-control" name="designation">
                                @foreach($designation as $d)
                                    <option value="{{  $d->id }}" {{ old('designation') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>


                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Sport Code </label>
                            <select class="form-control" id="firstName" name="sport"
                                    value=""
                                    type="text">
                                <option></option>
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->id }}" {{ old('sport') == $sport->id ? 'selected' : '' }}>{{$sport->name}}</option>
                                @endforeach


                            </select>
                            <label class="label label-success">If you cannot see a sport
                                on
                                the list, contact admin</label>

                        </div>


                    </div>

                    <div class="row">
                        <br/><br/>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Address</label>
                            <textarea class="form-control" rows="5" name="address"
                            >{{ old('address') }}</textarea>

                        </div>
                        <div class="col-lg-8">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Telephone <label class="label label-success">optional</label></label>
                                <input class="form-control" name="telephone"
                                       value="{{ old('telephone') }}"
                                       type="tel">

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="firstName">Email  <label class="label label-success">optional</label></label>
                                <input class="form-control" name="email"
                                       value="{{ old('email') }}"
                                       type="email">

                            </div>

                            <div class="col-md-6 mb-3">
                                <br/>
                                <label for="firstName">Mobile</label>
                                <input class="form-control" name="mobile"
                                       value="{{ old('mobile') }}"
                                       type="tel">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <br/><br/>






                    </div>

                    <div class="row">

                        <br/>
                        <div class="col-lg-12">
                            <br/>
                            <div class="alert alert-info">
                                <p><b>Make sure the input is correct and you have confirmed with the original document before clicking "Save" button</b></p>
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg"
                                   value="I Have Confirmed, Save The Record">
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>


    </div>


@include('templates.footer')