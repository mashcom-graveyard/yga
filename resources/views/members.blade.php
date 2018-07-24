@include('templates.header')


<div class="containefr">
    <h2 class="text-center"><b>Registered People</b></h2>
    <br/>


    <div class="row col-lg-10 col-lg-offset-1">
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
        <div class="col-lg-12">
            <center>
                <div class="col-lg-6">
                    <form method="get">
                        <div class="input-group input-group-sm">
                            <input name="q" class="form-control pull-right" placeholder="Search" type="text">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </center>
        </div>

        <br/> <br/> <br/> <br/> <br/>



        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Fullname</th>
                    <th>DOB</th>
                    <th>National ID</th>
                    <th>Gender</th>
                    <!--<th>Email</th>-->
                    <th>Mobile</th>
                    <!--<th>Telephone</th>-->
                    <th>Province</th>
                    <th>Sport</th>
                    <th>Designation</th>

                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($members as $member)
                    <tr>
                        <td><b>{{ $member->firstname ." ".$member->surname }}</b></td>
                        <td>{{ $member->dob }}</td>
                        <td><b>{{ $member->national_id }}</b></td>
                        <td>{{ $member->gender }}</td>
                        <!--  <td>// $member->email </td>-->
                        <td>{{ $member->mobile }}</td>
                        <!-- <td> $member->telephone </td>-->
                        <td>{{ $member->member_province->name }}</td>
                        <td>{{ $member->member_sport->name }}</td>
                        <td>{{ $member->member_designation->name }}</td>
                        <td>

                            <a href="{{ url('/member/'.$member->id)  }}"
                               class="btn btn-xs btn-primary btn-inline">View</a>
                        </td>
                        <td>
                            <button onclick="deleteDialog(<?php echo $member->id ?>,'members','<?php echo $member->firstname ." ".$member->surname ?>')" class="btn btn-danger btn-xs btn-inline">Delete</button>
                        </td>
                        <td><a href="{{ url('/pdf/'.$member->id)  }}"
                               class="btn btn-xs btn-primary">Print Card</a></td>


                    </tr>
                @endforeach

                </tbody>
            </table>


            {{ $members->links() }}
        </div>

    </div>
</div>
@include('templates.footer')