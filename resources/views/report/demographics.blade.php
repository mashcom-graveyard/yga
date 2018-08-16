@include('templates.header')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<style type="text/css">
	body{
		background: #eee !important; 
	}
</style>
<?php

        $males = \App\Member::whereGender('male')->count();
        $females = \App\Member::whereGender('female')->count();

        $provinces = \App\Province::all();

        $province_data = [];
        foreach ($provinces as $p) {
        	$count = \App\Member::whereProvince($p->id)->count();
        	array_push($province_data, ["name"=>$p->name,'y'=>$count]); 
        }

        $sports = \App\Sport::orderBy('name','ASC')->get();

       
        
        

?>

<table id="datatable" style="display: none !important">
  <thead>
    <tr>
      <th></th>
      <th>Age</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		 for ($i=5; $i <= 50 ; $i++) {  
        	$age = \Carbon\Carbon::now()->subYears($i)->format('Y-m-d');
        	$now = \Carbon\Carbon::parse($age)->addYears(1)->format('Y-m-d');
        	//dump("between $now and $age");
        	$people =  \App\Member::whereBetween('dob',[$age,$now])->count();
        	//dump($people);
			//dump("$people with age $i");
			?>
				<tr>
			      <th>{{ $i ." years" }} </th>
			      <td>{{ $people }}</td>
    			</tr>
			<?php
        }
  	?>
    
   
  </tbody>
</table>

<table id="sportdatatable" style="display: none !important">
  <thead>
    <tr>
      <th></th>
      <th>Sport</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		 foreach($sports as $sport) {
        	
			?>
				<tr>
			      <th>{{ $sport->name }} </th>
			      <td>{{ $sport->sport_members->count() }}</td>
    			</tr>
			<?php
        }
  	?>
    
   
  </tbody>
</table>

<div class="col-lg-12">
    <h2 class="text-center bold"><b>Demographics</b></h2>
    <br/>
    <div class="col-lg-6">
   		<div id="container" class="panel"></div>
	</div>
	<div class="col-lg-6">
   		<div id="gender" class="panel"></div>
	</div>
	<div class="col-lg-12">
		<br/><br/>
   		<div id="agedist" class="panel"></div>
	</div>

	<div class="col-lg-12">
		<br/><br/>
   		<div id="sportdist" class="panel"></div>
	</div>

</div>
<script type="text/javascript">
	

Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  style:{
    fontFamily: 'eina'
  },
  title: {
    text: 'Member Distribution by Province'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: <?php echo json_encode($province_data); ?>
  }]
});

Highcharts.chart('gender', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  style:{
    fontFamily: 'eina'
  },
  title: {
    text: 'Gender Distribution'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: [{
    	name:'Male',
    	y:<?php echo $males ;?>
    },{
    	name:'Female',
    	y:<?php echo $females ;?>
    }]
  }]
});

Highcharts.chart('agedist', {
  data: {
    table: 'datatable'
  },
  chart: {
    type: 'column'
  },
  style:{
    fontFamily: 'eina'
  },
  title: { 
    text: 'Age Distribution Graph'
  },
  yAxis: {
    allowDecimals: false,
    title: {
      text: 'Number of Members'
    }
  },
  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y + ' members: ' + this.point.name.toLowerCase();
    }
  }
});

Highcharts.chart('sportdist', {
  data: {
    table: 'sportdatatable'
  },
  chart: {
    type: 'column'
  },
  style:{
    fontFamily: 'eina'
  },
  title: { 
    text: 'Sport Code Distribution Graph'
  },
  yAxis: {
    allowDecimals: false,
    title: {
      text: 'Number of Members'
    }
  },
  tooltip: {
    formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
        this.point.y + ' members: ' + this.point.name.toLowerCase();
    }
  }
});
</script>
@include('templates.footer')
