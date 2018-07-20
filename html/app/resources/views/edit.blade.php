@include('templates.header')

<div class="container">
    <h2 class="text-center"><b>Edit Member Details</b></h2>

    <div class="row justify-content-center">

        <div class="row col-lg-12">
            <h2 class="mb-3 text-center"></h2>
        </div>

        <div class="col-md-10">
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
            <form class="needs-validation" method="post" action='{{ url("member/update/$member->id") }}'>

                {{ csrf_field()  }}


                <div class="row">

                    <br/><br/>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Province</label>
                        <select class="form-control" id="firstName" name="province"
                                value="" required=""
                                type="text">
                            <option></option>

                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" <?php if($province->id==$member->province) ?> >{{$province->name}}</option>
                            @endforeach


                        </select>
                    </div>


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
                </div>


                <div class="row">
                    <br/><br/>
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
                        <label for="firstName">National ID</label>
                        <input class="form-control" name="national_id" placeholder="National ID Number"
                               value="{{ $member->national_id }}" required=""
                               type="text">

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
                            <label for="firstName">Telephone</label>
                            <input class="form-control" name="telephone"
                                   value="{{ $member->telephone }}" required=""
                                   type="text">

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="firstName">Email</label>
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
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Date of Birth</label>
                        <input class="form-control" name="dob" placeholder="dd-mm-yyyy"
                               value="{{ $member->dob }}" required=""
                               type="date">

                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="firstName">Sport</label>
                        <input class="form-control" name="sport"
                               value="{{ $member->sport }}" required=""
                               type="text">

                    </div>

                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <br/>
                        <label for="firstName">Theme</label>
                        <input class="form-control" name="theme"
                               value="{{ $member->theme }}" required=""
                               type="text">

                    </div>
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


@include('templates.footer')