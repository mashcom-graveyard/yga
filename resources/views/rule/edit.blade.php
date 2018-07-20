@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Allocation of Game Venue/Village</b></h2>
    <h5 class="text-bold text-center">Update the allocation of Game Venue/Village</h5>
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
    <div class="col-lg-6 col-lg-offset-3">
        <form method="post" action="{{ route('rules.update',$rule->id) }}">

            <div class="form-group">

                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id" id="update_id" value="">
                <input type="hidden" name="section" id="update_section" value="">
                <label for="">Category</label>
                <select type="text" name="category" readonly="" id="" class="form-control" required>

                    @foreach($categories as $category)
                        @if($rule->category == $category->id)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach

                </select>

                <label for="">Sport Code</label>
                <select type="text" name="sport" readonly="" id="" class="form-control" required>

                    @foreach($sports as $sport)
                        @if ($rule->sport_id == $sport->id)
                            <option value="{{$sport->id}}">{{$sport->name}}</option>
                        @endif
                    @endforeach
                </select>

                <hr/>
                <label for="">Male Games Venue</label>
                <select type="text" name="male_venue" id="" class="form-control" required>
                    <option value=""></option>
                    @foreach($venues as $venue)
                        <option value="{{$venue->id}}" <?php if (json_decode($rule->male)->venue == $venue->id) {
                            echo "selected";
                        } ?>>{{$venue->name}}</option>
                    @endforeach
                </select>
                <label for="">Male Games Village</label>
                <select type="text" name="male_village" id="" class="form-control" required>
                    <option value=""></option>
                    @foreach($venues as $venue)
                        <option value="{{$venue->id}}" <?php if (json_decode($rule->male)->village == $venue->id) {
                            echo "selected";
                        } ?>>{{$venue->name}}</option>
                    @endforeach
                </select>
                <hr/>

                <label for="">Female Games Venue</label>
                <select type="text" name="female_venue" id="" class="form-control" required>
                    <option value=""></option>
                    @foreach($venues as $venue)
                        <option value="{{$venue->id}}" <?php if (json_decode($rule->female)->venue == $venue->id) {
                            echo "selected";
                        } ?>>{{$venue->name}}</option>
                    @endforeach
                </select>
                <label for="">Female Games Village</label>
                <select type="text" name="female_village" id="" class="form-control" required>
                    <option value=""></option>
                    @foreach($venues as $venue)
                        <option value="{{$venue->id}}" <?php if (json_decode($rule->female)->village == $venue->id) {
                            echo "selected";
                        } ?>>{{$venue->name}}</option>
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


@include('templates.footer')