@extends('layouts.master')

@section('topscript')

<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>
<link rel="stylesheet" href="/bootstrap-3.2.0/css/slider.css" >
@stop

@section('content')
<!-- checking/displaying errors based on validation rules in User model -->
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
<!-- end error display section -->
<!-- user information that can be edited and updated -->
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
		<td>{{Form::text('first_name', $user->first_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('last_name', $user->last_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('email', $user->email, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('amount_per_tweet', $user->amount_per_tweet, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('report_frequency', $user->report_frequency, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('monthly_goal', $user->monthly_goal, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
	</tr>
</table>
{{Form::close()}}
</div>
<div class="row">
	<div class="col-md-12">
	    <h2 class="page-header">Charities</h2>
	</div>
</div>
<!-- end user data section -->

<!-- charities section -->
<div class="row">

	@foreach ($user->charities as $charity)
	{{ Form::model($user->charities, array('action' => array('HomeController@removeCharity'), 'method' => 'GET')) }}
		{{Form::hidden('user_id',$user->id)}}
		{{Form::hidden('charity_id', $charity->id)}}
		<div class="row">
			<div class="col-md-1 col-sm-1">
				<img class="img-circle img-responsive" style="width: 75px" src="{{$charity->profile_picture_link}}" alt="{{$charity->charity_name}}">
			</div>
			<div class="col-md-2 col-sm-2">
				<h3>{{$charity->charity_name}}</h3>
			</div>
			<div class="col-md-4 col-sm-4">
				<input type="range" class="span2 sliderValue" value="4" id="slider" data-slider-max="100">
			</div>
			<div class="col-md-2 col-sm-4">
				{{Form::text('allotted_percent', $charity->pivot->allotted_percent)}}
			</div>
			<div class="col-md-2 col-sm-2">
			{{Form::submit('Remove',"", array('class' => 'btn btn-danger form-group btnRemove', 'id' => 'remove'))}}
			</div>
		</div>
{{Form::close()}}
	@endforeach
</div>
{{Form::Submit('Add Charity', array('class' => 'btn btn-success form-group', 'id' => 'new'))}}
{{Form::close()}}
<!-- end charities section -->

<!-- Individual Metrics to be entered below -->

<!-- <h3>Donations by Number of Tweets</h3>
<table class="table table-hover table-striped table-responsive">
<tr>
	<th>Tweets</th>
	<th>Pledge</th>
</tr>
@for ($i = 10; $i < 1000; $i+=10)
	@if (($user->amount_per_tweet)*$i <= $user->monthly_goal)
	<td>{{$i}}</td>
	<td>{{'$' . ($user->amount_per_tweet)*$i}}</td>
	@endif
<tr>
@endfor
	
</tr>
</table> -->

@stop

@section('bottomscript')
<script>


$('.sliderValue').slider().on('slideStop', function() {
 	console.log ($(this).slider('getValue').val());
 	 
 });
</script>


@stop