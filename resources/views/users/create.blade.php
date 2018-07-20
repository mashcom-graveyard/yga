@include('templates.header')
<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2 class="text-center"><b>Create User Account</b></h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="post" action="{{ route('users.store') }}">

                {{ csrf_field() }}
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>Fullname:</label>
                            <input type="text" name="name" id="first_name" class="form-control "
                                   placeholder="Name" tabindex="1" value="{{ old('name') }}">
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" id="email" class="form-control "
                           placeholder="Email Address" tabindex="4" value="{{ old('email') }}">
                </div>


                <div class="form-group">
                    <label>Province:</label>
                    <select class="form-control " name="province">
                        @foreach($provinces as $province)
                            @if(\Illuminate\Support\Facades\Auth::user()->access_level==3)
                                @if(\Illuminate\Support\Facades\Auth::user()->province_id == $province->id)
                                    <option value="{{ $province->id }}">{{$province->name}}</option>
                                @endif
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->access_level==1)
                                <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
                            @endif

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Access Level:</label>
                    <select class="form-control" name="access_level">
                        @if(\Illuminate\Support\Facades\Auth::user()->access_level==1)
                            <option value="1" {{ old('access_level') == 1 ? 'selected' : '' }}>Administrator</option>
                        @endif
                        <option value="3" {{ old('access_level') == 3 ? 'selected' : '' }}>General Manager</option>
                        <option value="2" {{ old('access_level') == 2 ? 'selected' : '' }}>Standard</option>
                    </select>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-bold"><b>Default password is youth2018</b></h4>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <input type="text" name="password" id="password" class="form-control "
                                   placeholder="Password" tabindex="5" value="youth2018">
                        </div>
                    </div>

                </div>


                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-12"><input type="submit" value="Register"
                                                            class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                </div>
            </form>
        </div>
    </div>