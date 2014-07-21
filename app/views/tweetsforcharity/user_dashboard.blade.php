@extends('layouts.master')

@section('topscript')


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<!-- <script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script> -->
<link rel="stylesheet" href="/bootstrap-3.2.0/css/slider.css" >
<link rel="stylesheet" href="/css/main.css" >

@stop

@section('content')
<!-- checking/displaying errors based on validation rules in User model -->
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
<!-- end error display section -->
<!-- Donor information that can be edited by user -->
{{ Form::model($user, array('action' => array('UsersController@update', $user->twitter_handle), 'method' => 'PUT')) }}
<div class="row"><img src='{{$user->profile_picture_link}}' alt="profile picture" style="width:100px"class='img-circle img-responsive'></div>
<div class="row"><table class="table table-hover table-striped table-responsive">

	<tr>
		<th>Twitter Handle</th>
		<th>{{Form::label('first_name','First Name')}}</th>
		<th>{{Form::label('last_name','Last Name')}}</th>
		<th>{{Form::label('email','Email')}}</th>
		<th>{{Form::label('amount_per_tweet','Amount/Tweet', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('report_frequency','Report Frequency', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('monthly_goal','Max Contribution', array('class' => 'text-center'))}}</th>
		<th>Action</th>
	</tr>
	<tr>
		<td><h4>{{$user->twitter_handle}}</h4></td>
		<td>{{Form::text('first_name', $user->donor->first_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('last_name', $user->donor->last_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('email', $user->email, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('amount_per_tweet', $user->donor->amount_per_tweet, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('report_frequency', $user->donor->report_frequency, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('monthly_goal', $user->donor->monthly_goal, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
	</tr>
</table>
{{Form::close()}}
</div>
<!-- end Donor data section -->
	<div class="row">
		    <h2 class="page-header">Charities</h2>
	</div>
<div class="row">
	<div class="col-md-12">
	<!-- Sidebar -->
	<div class="col-sm-2">
		<h4>Available Charities</h4>
		{{ Form::model($user->donor->charities, array('action' => array('HomeController@addCharity'), 'method' => 'GET')) }}
	    @foreach ($charities as $charity)
		    <div>{{link_to_action('HomeController@addCharity', 'Add', array('attach_to_user_id' => $user->id, 'charity_id' => $charity->id))}}<img src="{{$user->profile_picture_link}}" style="height:50px">{{$charity->charity_name}}</div>
	    @endforeach
	    <div class="text-left">{{ $charities->links() }}</div>
	</div>
	{{Form::close()}}
	<!-- end sidebar -->
	<!-- charities section -->
	<div class="col-sm-9">
		<h4>Selected Charities</h4>
		@foreach ($user->donor->charities as $charity)
		{{ Form::model($user->donor->charities, array('action' => array('HomeController@removeCharity'), 'method' => 'GET')) }}
			{{Form::hidden('charity_id', $charity->id)}}
			{{Form::hidden('user_id', $user->id)}}
			<div class="row">
				<div class="col-md-1 col-sm-1">
					<img class="img-circle img-responsive" style="width: 75px" src="{{$user->profile_picture_link}}" alt="{{$charity->charity_name}}">
				</div>
				<div class="col-md-2 col-sm-2">
					<h3>{{$charity->charity_name}}</h3>
				</div>
				<div class="col-md-5 col-sm-2">
					<input type="range" class="span2 sliderValue" value="4" id="slider" data-slider-max="100">
				</div>
				<div class="col-md-1 col-sm-1">
					{{Form::text('allotted_percent', $charity->pivot->allotted_percent)}}
				</div>
				<div class="col-sm-2 col-sm-1 pull-right">
				{{Form::submit('Remove', array('class' => 'btn btn-danger form-group btnRemove', 'id' => 'remove'))}}
				</div>
			</div>
	{{Form::close()}}
		@endforeach
	</div>	<!-- end charities section -->
</div>  <!-- end grid col-md-12 -->
</div> <!-- end row -->
@stop

@section('bottomscript')
<script>

$('#charitySelect').change(function (){
	console.log ($(this).find(":selected").text());
	$('#selectedCharity').text($(this).find(":selected").text());
	console.log ($('#selectedCharity').text());
 });
$('.sliderValue').slider().on('slideStop', function() {
 	console.log ($(this).slider('getValue').val()); 	 
 });
</script>


@stop