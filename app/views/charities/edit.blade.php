@extends('layouts.master')

@section('topscript')

<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>

@stop

@section('content')
{{ Form::model($user, array('action' => array('CharitiesController@update', $user->twitter_handle), 'method' => 'PUT')) }}
<table class="table table-striped table-responsive">
	<tr>
		<th>Twitter Handle</th>
		<th>Charity Name</th>
		<th>Tax ID</th>
		<th>Email</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Street Address</th>
		<th>City</th>
		<th>State</th>
		<th>Zip</th>
		<th>Edit Charity</th>
	</tr>
	<tr>
		<td>{{ $user->twitter_handle }}</td>
		<td>{{Form::text('charity_name', $charity->charity_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('tax_id', $charity->tax_id, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('email', $user->email, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('first_name', $user->first_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('last_name', $user->last_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('phone', $charity->phone, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('street', $charity->street, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('city', $charity->city, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('state', $charity->state, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('zip', $charity->zip, array('class' => 'form-control'))}}</td>
		<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
	</tr>
</table>
{{Form::close()}}
<!-- name and logo of the charity that is logged in  -->
<div class="col-md-4 text-center v-center">    
	<h2>{{$charity->charity_name}}</h2>	
        <img class="img-circle img-responsive" src="{{$user->profile_picture_link}}" alt="{{$charity->charity_name}}">
</div>

<div class="col-md-8 text-center v-center">
	<h3>Number of Donators to Charity</h3>
</div>	

@stop

@section('bottomscript')