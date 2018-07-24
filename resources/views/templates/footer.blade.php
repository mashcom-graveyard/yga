<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <form method="post" action="{{ url('/section/update') }}">

                    <div class="form-group">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="update_id" value="">
                        <input type="hidden" name="section" id="update_section" value="">
                        <label for="">Current Name</label>
                        <input type="text" readonly name="current_name" id="update_current_value" class="form-control">

                        <label for="">New Name</label>
                        <input type="text" name="name" id="" class="form-control" required>

                    </div>

                    <div class="form-group">
                        <input type="submit" value="Save Changes" class="btn btn-md btn-primary">

                    </div>

                </form>

            </div>


        </div>

    </div>

</div>



<div id="deleteModal" class="modal fade">

    <div class="modal-dialog modal-danger">

        <div class="modal-content">

            <div class="modal-header ">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"><b>Confirmation Delete Action</b></h4>

            </div>

            <div class="modal-body">

                <form method="post" action="#">

                    <div class="form-group">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="m_update_id" value="">
                        <input type="hidden" name="section" id="m_update_section" value="">
                        <input type="hidden" name="_method" value="DELETE">
                        <label for="">Record to be deleted</label>
                        <input type="text" name="current_name" id="m_update_current_value" value="" readonly
                               class="form-control">


                    </div>

                    <div class="form-group">
                        <input type="submit" value="Delete Record" class="btn btn-md btn-danger">

                    </div>

                </form>

            </div>


        </div>

    </div>

</div>


<br/>
<br/>
<br/><br/><br/>

<footer class="my-5 pt-5 text-muted text-center text-small footer navbar-fixed-bottom" style="background: #f5f5f5;
    ">
    <h6 class="text-danger text-center"><b>
            Logged in as
            @if(\Illuminate\Support\Facades\Auth::user()->access_level ==1)
                Admistrator
            @endif

            @if(\Illuminate\Support\Facades\Auth::user()->access_level ==2)
                - {{ \Illuminate\Support\Facades\Auth::user()->user_province->name }} Province Standard User
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->access_level ==3)
                - {{ \Illuminate\Support\Facades\Auth::user()->user_province->name }} Province General Manager
            @endif
        </b>-
        <b>Youth Games Accreditation System v1.0 &copy; {{ date('Y') }}. All Rights
            Reserved.</b></h6>

</footer>
</div>
</body>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script type="text/javascript">

    function updateSection(id, section_type, current_value) {

        $("#update_id").val(id);
        $("#update_section").val(section_type);
        $("#update_current_value").val(current_value);
        $("#myModal").modal('show');
    }

    function updateAccessZones(id, section_type, current_value) {

        $("#z_update_id").val(id);
        $("#z_update_section").val(section_type);
        $("#z_update_current_value").val(current_value);
        $("#zonesModal").modal('show');
    }

    function deleteDialog(id, section_type, current_value) {
        $("#m_update_id").val(id);
        $("#m_update_section").val(section_type);
        $("#m_update_current_value").val(current_value);

        var url = null;

        if (section_type == 'members') {
            url = "member";
        }
        else if (section_type == "rules") {
            url = "rules";
        } else {
            alert('action could not be determined');
            return;
        }
        $("#deleteModal form").attr('action', 'https://youthgames.changamire.com/' + url + '/' + id);
        $("#deleteModal").modal('show');
    }

    function captureDialog() {
        $("#captureModal").modal('show');
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width('100%')
                    .height('auto');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


</html>
