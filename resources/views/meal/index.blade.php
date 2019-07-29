@include('templates.header')


<div class="container">

    <h2 class="text-bold text-center"><b>Meals Consumption Report</b></h2>
    <h5 class="text-bold text-center">View Meals Consumption per day</h5>
  
    <br/><br/>
  <div class="row"> 
    <div class="col-lg-12  well bs-component" style="margin:1%;">
       @if(isset($filter) && @$filter!=false)
                <div class="alert alert-success">
                    {{ $filter }}
                </div>
            @endif
       <form action="" method="GET">
         <div class="col-md-4 mb-3" style="display: nodne !important;">
                             <label for="firstName">Filter by Date</label>
                             <div style="width: 100% !important;">
                                  <select name="day" id="adobday" class="form-control" style="width: 32% !important;float: left !important;"></select>
                                  <select name="month" id="adobmonth" class="form-control" style="width: 32% !important;float: left !important;"></select>
                                <select name="year" id="adobyear" class="form-control" style="width: 32% !important;float: left !important;"></select>
                              </div>
             <input type="submit" class="btn  btn-primary text-bold" style="margin-top:1%;font-weight:bold;" value="Filter"/>
          </div>
       
      </form>
    </div>
   
    <div class="col-lg-12 mx-auto">
     @if($meals->count()>0)
        <table class="table table-striped">
            <tr>
                <th>Meal</th>
                <th>Venue</th>
                <th>Total</th>
            </tr>

          <?php  $index=0; ?>
            @foreach($meals as $meal)
             
          <tr>
                    <td><b><?php echo $meal->meal_type ?></b></td>
                    <td><b><?php echo $meal->venue ?></b></td>
                    <td><b><?php echo $meal->total ?></b></td>
                </tr>
          <?php $index++;?>
            @endforeach
        </table>
      @else
        <div class="alert alert-danger" style="font-weight:bold;">
          No results found
      </div>
      @endif
    </div>
</div>
  

  <div class="row">
      <h2 class="text-bold text-center"><b>Total Meals Servings</b></h2>
    <h5 class="text-bold text-center">These are meals served so far</h5>
    <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Breakfast</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{$breakfast}}</b></h1></div>
               </div>
        </div>
      <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Lunch</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{$lunch}}</b></h1></div>
               </div>
        </div>
      <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Supper</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{$supper}}</b></h1></div>
           </div>
        </div>
     <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><b>Grand Total</b></div>
                <div class="panel-body"><h1 class="text-center"><b>{{$breakfast+ $lunch + $supper}}</b></h1></div>
           </div>
        </div>
  </div>

</div>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>



<script src="{{ asset('js/dobPicker.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $.dobPicker({
            // Selectopr IDs
daySelector: '#adobday',
monthSelector: '#adobmonth',
yearSelector: '#adobyear',


// Minimum age
minimumAge: 0,

// Maximum age
maximumAge: 100
        });
    });
 </script>

@include('templates.footer')