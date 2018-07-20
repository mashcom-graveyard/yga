@include('templates.header')


<div class="containefr">
    <h2 class="text-center"><b>Registered People</b></h2>
    <br/>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">


                <form class="form" method="get" >

                    <div class="col-lg-2 form-group">
                        <label>Province</label>
                        <select name="province_filter" id="" class="form-control input-xs">
                            <option></option>
                            @foreach($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <input type="submit" value="Apply Filter" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
<!--
        <div class="col-lg-6">
            <form action="" method="get" class="form-group">
                <label>Search:</label>
                <input type="search" name="search" class="form-control">
            </form>
        </div>-->
        <br/> <br/> <br/> <br/> <br/>
    </div>

    <div class="row justify-content-center">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>DOB</th>
                <th>National ID</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Telephone</th>
                <th>Province</th>
                <th>Sport</th>
                <th>Designation</th>

                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->firstname ." ".$member->surname }}</td>
                    <td>{{ $member->dob }}</td>
                    <td>{{ $member->national_id }}</td>
                    <td>{{ $member->gender }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->mobile }}</td>
                    <td>{{ $member->telephone }}</td>
                    <td>{{ $member->member_province->name }}</td>
                    <td>{{ $member->sport }}</td>
                    <td>{{ $member->member_designation->name }}</td>
                    <td><a href="{{ url('/member/'.$member->id.'/edit')  }}"
                           class="btn btn-xs btn-primary">Edit/View</a></td>


                </tr>
            @endforeach

            </tbody>
        </table>


        {{ $members->links() }}
    </div>
</div>
@include('templates.footer')