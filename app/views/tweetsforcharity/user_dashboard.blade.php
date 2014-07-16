@extends('layouts.master')

@section('topscript')

<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>

@stop

@section('content')
{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
<table class="table table-hover table-striped table-responsive">
	<tr>
		<th>{{Form::label('twitter_handle','Twitter Handle')}}</th>
		<th>{{Form::label('first_name','First Name')}}</th>
		<th>{{Form::label('last_name','Last Name')}}</th>
		<th>{{Form::label('Email','Email')}}</th>
		<th>{{Form::label('amount_per_tweet','Amount/Tweet', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('report_frequency','Report Frequency', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('monthly_goal','Max Contribution', array('class' => 'text-center'))}}</th>
		<th>Action</th>
	</tr>
	<tr>
		<td>{{Form::text('twitter_handle', $user->twitter_handle, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('first_name', $user->first_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('last_name', $user->last_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('Email', $user->email, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('amount_per_tweet', $user->amount_per_tweet, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('report_frequency', $user->report_frequency, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('monthly_goal', $user->monthly_goal, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
	</tr>
</table>
	{{Form::close()}}

<div class="row">
	<div class="col-md-12">
	    <h2 class="page-header">Charities</h2>
	</div>
</div>
{{ Form::model($user->charities, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
<div class="row">
	@foreach ($user->charities as $charity)
    <div class="col-md-4 col-sm-6">
        <img class="img-circle img-responsive" src="{{$charity->profile_picture_link}}" alt="{{$charity->charity_name}}">
		<h2>{{$charity->charity_name}}</h2>
		<div class="well">
            <div class="slider slider-horizontal" style="width: 140px;">
<!--             	<div class="slider-track">
            		<div class="slider-selection" style="left: 0%; width: 50%;"></div>
            		<div class="slider-handle round" style="left: 50%;"></div>
            		<div class="slider-handle round hide" style="left: 0%;"></div>
            	</div>
            	<div class="tooltip top" style="top: -40px; left: 23px;">
            		<div class="tooltip-arrow"></div>
            		<div class="tooltip-inner">Current value: 5</div>
            	</div> -->
            	<input type="text" class="span2 sliderValue" value="4" id="slider" data-slider-max="100">
            </div>
          </div>
		{{Form::text('alloted_percent', $charity->pivot->alloted_percent, array('class' => 'form-control'))}}
		{{Form::Submit('Remove', array('class' => 'btn btn-danger form-group', 'id' => 'remove'))}}
	</div>
@endforeach
</div>
{{Form::Submit('Add Charity', array('class' => 'btn btn-success form-group', 'id' => 'new'))}}
	{{Form::close()}}
<h3>Donations by Number of Tweets</h3>
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
</table>

@stop

@section('bottomscript')
<script>

$('.sliderValue').slider().on('slideStop', function() {
	console.log ($(this).slider('getValue').val());
});


</script>
@stop