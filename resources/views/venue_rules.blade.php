@include('templates.header')

<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2 class="text-center"><b>{{$venue->name }} -Access Rules</b></h2>
            <h5 class="text-center"><b>Manage who has access to a Venue</b></h5>

            @if(session('success'))
                <div class="alert alert-success">
                    <b> {{ session('success') }}</b>
                </div>
            @endif
            <form method="post" action="{{ url("/venue/$venue->id/rules") }}">
                {{ csrf_field() }}
                <label for="">Gender Based</label>
                <select type="text" name="gender_rule" class="form-control">
                    <option value="GE">Every One</option>
                    <option value="GM">Males Only</option>
                    <option value="GF">Females Only</option>

                </select>
                <br/>
                <label for="">Sport Based</label>
                <select type="text" name="sport_rule" ng-changed="toggleSA()" class="form-control">
                    <option value="SE" ng-selected="toggleSA()">Every Sport</option>
                    <option value="SS" ng-selected="ss=true">Specific Sport Only</option>

                </select>
                @{{ ss }}
                <br/>
                <div ng-if="ss==true">
                    <label for="">Sports Allowed</label><br/>
                    <select multiple name="sport_allowed[]" style="width: 100%;height: 200px;">
                        @foreach($sports as $sport)
                            <option type="checkbox" value={{$sport->id}}>{{$sport->name}}</option>
                        @endforeach
                    </select>
                </div>

                <br/><br/><br/>
                <input type="submit" value="Save Rules" class="btn btn-primary btn-md">
            </form>

        </div>

    </div>

</div>

<script>
    angular.module('TMS', [])
        .controller('AppCtrl', function AppController($scope) {

            $scope.ss = false;

            $scope.toggleSA = function () {
                alert("ff");
            }

        });
</script>
@include('templates.footer')