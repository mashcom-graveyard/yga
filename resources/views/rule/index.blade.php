@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Game Venue/Village Allocation</b></h2>
    <h5 class="text-bold text-center">Manage allocation of venues/villages to sports and categories</h5>
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
    <div class="col-lg-12">
        <button class="btn btn-success"
                onclick="updateSection('','sport','')"><b>Allocate Venues/Villages</b>
        </button>
        <br/><br/><br/>
        <table class="table table-striped table-bordered">
            <tr>
                <!--  <th>ID</th>-->
                <th>Sport Code</th>
                <th>Category</th>
                <th>Sex</th>
                <th>Game Venue</th>
                <th>Game Village</th>
            </tr>

            @foreach($rules as $sport)

                <tr>
                <!-- <td>{{ $sport->id }}</td>-->
                    <td rowspan="2"><b>{{ App\Sport::find($sport->sport_id)->name }}</b></td>
                    <td rowspan="2"><b>{{ App\Category::find($sport->category)->name }}</b></td>

                    <td>Male</td>
                    <td>{{ App\Venue::find(json_decode($sport->male)->venue)->name }}</td>
                    <td>{{ App\Venue::find(json_decode($sport->male)->village)->name }}</td>
                    <td rowspan="2">
                        <a href="{{ url('/rules/'.$sport->id.'/edit') }}" class="btn btn-primary btn-xs"><b>Edit</b></a>
                        <button onclick="deleteDialog(<?php echo $sport->id ?>,'rules','<?php echo App\Sport::find($sport->sport_id)->name."-".App\Category::find($sport->category)->name ?>')" class="btn btn-danger btn-xs btn-inline">Delete</button>
                    </td>

                </tr>
                <tr>
                    <td>Female</td>
                    <td>{{ App\Venue::find(json_decode($sport->female)->venue)->name }}</td>
                    <td>{{ App\Venue::find(json_decode($sport->female)->village)->name }}</td>


                </tr>

            @endforeach
        </table>
    </div>


    <div id="myModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Allocation of Games Venues and Villages</h4>

                </div>

                <div class="modal-body">

                    <form method="post" action="{{ url('/rules') }}">

                        <div class="form-group">

                            {{ csrf_field() }}

                            <input type="hidden" name="id" id="update_id" value="">
                            <input type="hidden" name="section" id="update_section" value="">
                            <label for="">Category</label>
                            <select type="text" name="category" id="" class="form-control" required>
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach

                            </select>
                            <label for="">Sport Code</label>
                            <select type="text" name="sport" id="" class="form-control" required>
                                <option value=""></option>
                                @foreach($sports as $sport)
                                    <option value="{{$sport->id}}">{{$sport->name}}</option>
                                @endforeach
                            </select>

                            <hr/>
                            <label for="">Male Games Venue</label>
                            <select type="text" name="male_venue" id="" class="form-control">
                                <option value=""></option>
                                @foreach($venues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                                @endforeach
                            </select>
                            <label for="">Male Games Village</label>
                            <select type="text" name="male_village" id="" class="form-control">
                                <option value=""></option>
                                @foreach($venues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                                @endforeach
                            </select>
                            <hr/>

                            <label for="">Female Games Venue</label>
                            <select type="text" name="female_venue" id="" class="form-control">
                                <option value=""></option>
                                @foreach($venues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                                @endforeach
                            </select>
                            <label for="">Female Games Village</label>
                            <select type="text" name="female_village" id="" class="form-control">
                                <option value=""></option>
                                @foreach($venues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                                @endforeach
                            </select>
                            <hr/>


                        </div>

                        <div class="form-group">
                            <input type="submit" value="Save Changes" class="btn btn-md btn-primary">

                        </div>

                    </form>

                </div>


            </div>

        </div>

    </div>


</div>


@include('templates.footer')