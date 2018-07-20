@include('templates.header')


<div class="container">
    <h2 class="text-center"><b>System Users</b></h2>
    <h5 class="text-bold text-center">Manage list of users who can manupulate records</h5>
    <br/>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 pull-right">
            <a href="{{ url('/users/create') }}" class="btn btn-success btn-md pull-right">Create Account</a>
        </div>
        <br/><br/><br/>
    </div>

    <div class="row justify-content-center">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Province</th>
                <th>
                    Status
                </th>
                <th>Access Role</th>
                <th>Created</th>
                <th>Last Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td><b>{{ $user->email }}</b></td>
                    <td>
                        {{ $user->user_province->name}}
                    </td>
                    <td style="font-weight:bold">@if($user->is_active ==1)
                            <span class="text-success"> Active</span>
                        @else
                            <span class="text-muted">Inactive</span>
                        @endif</td>
                    <td>
                        <b><?php
                            if ($user->access_level == 1) {
                                echo "Admin";
                            } elseif ($user->access_level == 3) {
                                echo "General Manager";
                            } else {
                                echo "Standard";
                            } ?></b>
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>

                    @if($user->is_active==0)
                        <td><a class="btn btn-xs btn-success" href="{{ url('/users/toggle_status/'.$user->id) }}">activate</a>
                        </td>

                    @endif

                    @if($user->is_active==1)
                        <td><a class="btn btn-xs btn-warning" href="{{ url('/users/toggle_status/'.$user->id) }}">deactivate</a>
                        </td>

                    @endif


                </tr>
            @endforeach

            </tbody>
        </table>


        {{ $users->links() }}
    </div>
</div>
@include('templates.footer')