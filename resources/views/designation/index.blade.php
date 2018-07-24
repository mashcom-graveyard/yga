@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Manage Designations</b></h2>
    <h5 class="text-bold text-center">Manage list of designations available</h5>
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
    <br/><br/>
    <div class="col-lg-8">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Access Zones</th>
                <th>Member Count</th>
                <th></th>
                <th></th>
            </tr>

            @foreach($designations as $designation)
                <tr>
                    <td>{{ $designation->id }}</td>
                    <td><b>{{ $designation->name }}</b></td>
                    <td>
                        <?php

                        $azones = explode(',', $designation->zone_access);
                        foreach ($azones as $zone_label) {
                            echo "<label class='label label-success h3' style='margin: 3px;'>$zone_label</label>";
                        }


                        ?>
                    </td>
                    <td><b>{{ $designation->designation_members->count() }}</b></td>
                    <td>
                        <button class="btn btn-xs btn-primary"
                                onclick="updateSection('{{$designation->id}}','designation','{{$designation->name}}')">
                            <b>Update</b>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-primary"
                                onclick="updateAccessZones('{{$designation->id}}','zones','{{$designation->name}}')"><b>Access
                                Zones</b>
                        </button>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="col-lg-4">
        <form method="post">

            <div class="form-group">

                {{ csrf_field() }}
                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control">

            </div>

            <div class="form-group">
                <input type="submit" value="Add Designation" class="btn btn-md btn-primary">

            </div>

        </form>
    </div>

</div>
<div id="zonesModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Update Zones</h4>

            </div>

            <div class="modal-body">

                <form method="post" action="{{url('/designation/zone/update')}}">

                    <div class="form-group">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="z_update_id" value="">
                        <input type="hidden" name="section" id="z_update_section" value="">
                        <label for="">Designation</label>
                        <input type="text" readonly name="designation" id="z_update_current_value"
                               class="form-control">
                        <br/>
                        <label for=""><b>Access Zones</b></label>
                        <br/>
                        @foreach($zones as $zone)
                            <label class="checkbox-inline"><input type="checkbox" name="zone[]" value="{{$zone->id}}"><b>{{$zone->id}}. {{ $zone->name}}</b></label>
                            <br/>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Save Changes" class="btn btn-md btn-primary">

                    </div>

                </form>

            </div>


        </div>

    </div>

</div>


@include('templates.footer')