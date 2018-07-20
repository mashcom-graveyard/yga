@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Access Settings</b></h2>
    <h5 class="text-bold text-center">Update access settings for catering and transport services</h5>
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
        <h4>Catering</h4>

        <h5>Code - C1</h5>
        <ul class="list-group">
            @foreach($designations as $designation)
                <li class="list-group-item">{{$designation->name}} <a href="#" class="label label-success pull-right">Allowed</a></li>
            @endforeach
        </ul>

    </div>


</div>


@include('templates.footer')