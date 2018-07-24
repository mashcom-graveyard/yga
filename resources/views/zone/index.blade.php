@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Manage Zone</b></h2>
    <h5 class="text-bold text-center">Manage list of zones available. These are used in Accredidation Card Printing</h5>
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
    <div class="col-lg-6">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </tr>

            @foreach($zones as $province)
                <tr>
                    <td>{{ $province->id }}</td>
                    <td><b>{{ $province->name }}</b></td>
                    <td>
                        <button class="btn btn-xs btn-primary" onclick="updateSection('{{$province->id}}','zone','{{$province->name}}')"><b>Update</b>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="col-lg-6">
        <form method="post">

            <div class="form-group">

                {{ csrf_field() }}
                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control">

            </div>

            <div class="form-group">
                <input type="submit" value="Add Zone" class="btn btn-md btn-primary">

            </div>

        </form>
    </div>

</div>


@include('templates.footer')