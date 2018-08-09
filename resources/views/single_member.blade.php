@include('templates.header')

<div class="container">
    <h2 class="text-center"><b>Member Details</b></h2>

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


            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-lg-offset-1 toppad">

                        @if(\Illuminate\Support\Facades\Auth::check()):
                        <div class="pull-rightf">
                            <a href="{{ url('/member/'.$member->id.'/edit') }}" class="btn btn-md btn-primary">Edit
                                Profile</a>
                        @if(\Illuminate\Support\Facades\Auth::user()->access_level==1)
                            <a href="{{ url('/pdf/'.$member->id)  }}"
                               class="btn btn-xs btn-primary">Print Card</a></td>
                          @endif
                            <br/><br/>
                        </div>
                        @endif



                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><b>Member Details</b></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"><img alt="User Pic"
                                                                                        src="{{ asset('/images/'.$member->image) }}"
                                                                                        class="img-responsive">
                                    </div>


                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Fullname:</td>
                                                <td>{{ $member->firstname ." ".$member->surname }}</td>

                                            </tr>
                                            <tr>
                                                <td>Designation:</td>
                                                <td>{{ $member->member_designation->name }}</td>

                                            </tr>
                                            <tr>
                                                <td>Province:</td>
                                                <td>{{ $member->member_province->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sport</td>
                                                <td>{{ $member->member_sport->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date of Birth</td>
                                                <td>{{ $member->dob }}</td>
                                            </tr>

                                            <tr>
                                                <td>National ID #</td>
                                                <td>{{ $member->national_id }}</td>
                                            </tr>

                                            <tr>

                                            <tr>
                                                <td>Gender</td>
                                                <td>{{ $member->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td>Home Address</td>
                                                <td>{{ $member->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><a href="mailto:info@support.com">{{ $member->email }}</a></td>
                                            </tr>
                                            <td>Telephone Number</td>
                                            <td>{{ $member->telephone}}
                                            </td>

                                            </tr>

                                            <tr>
                                                <td>Mobile Number</td>
                                                <td>{{ $member->mobile }}</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>


@include('templates.footer')