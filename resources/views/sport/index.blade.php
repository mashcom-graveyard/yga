@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Manage Sports</b></h2>
    <h5 class="text-bold text-center">Manage list of sports available</h5>
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
        <table class="table table-striped table-bordered">
            <tr>
                <th>Sport Code</th>
            </tr>

            @foreach($sports as $sport)

                <tr>
                    <td><b>{{ $sport->name }}</b></td>

                    <td>
                        <button class="btn btn-xs btn-primary"
                                onclick="updateSection('{{$sport->id}}','sport','{{$sport->name}}')"><b>Update</b>
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
                <input type="submit" value="Add Sport" class="btn btn-md btn-primary">

            </div>

        </form>
    </div>
</div>


@include('templates.footer')