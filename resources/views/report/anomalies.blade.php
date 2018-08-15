@include('templates.header')

<div class="col-lg-10 col-lg-offset-1">
	<h2 class="text-center"><b>Data Anomalies</h2>
    <h5 class="text-center"><b>The following records might have some errors</b></h5>
    <br/><br/>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Fullname</th>
      <th>National ID</th>
      <th>DOB</th>
      <th>Province</th>
      <th>Sport</th>
      <th>Possible Anomalies</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($anomalies as $member)
   		<?php
   			$css_class='';
   			$message = '';
   			if($member->dob==null){
   				$css_class = "danger";
   				$message = "Date of birth not provided";

   			}
   			if($member->dob > \Carbon\Carbon::now()){
   				$css_class = "danger";
   				$message = "Date of birth greater that current date";
   			}

   			if($member->dob > \Carbon\Carbon::now()->subYears(7) && $member->dob < \Carbon\Carbon::now()){
   				$css_class = "warning";
   				$message = "Age questionable";
   			}

   		?>
   		<tr class="<?php echo $css_class ?>">
   			<td style="font-weight: bold">{{ $member->firstname ." ". $member->surname}}</td>
   			<td>{{ $member->national_id }} </td>
   			<td>{{ $member->dob }}</td>
   			<td>{{ $member->member_province->name }}</td>
   			<td>{{ $member->member_sport->name }}</td>
   			<td><strong>{{ $message }}</strong></td>
   		</tr>

   @endforeach
  </tbody>
</table>
</div>


@include('templates.footer')
