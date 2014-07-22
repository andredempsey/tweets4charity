@extends('layouts.master')

@section('topscript')

<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>

@stop

@section('content')
<table class="table table-striped table-responsive">
	<tr>
		<th>Twitter Handle</th>
		<th>Charity Name</th>
		<th>Tax ID</th>
		<th>Email</th>
		<th>Phone Number</th>
		<th>Street Address</th>
		<th>City</th>
		<th>State</th>
		<th>Zip</th>
		<th>Edit Charity</th>
	</tr>
	<tr>
		<td>{{ $user->twitter_handle }}</td>
		<td>{{ $user->charity->charity_name }}</td>
		<td>{{ $user->charity->tax_id }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->charity->phone }}</td>
		<td>{{ $user->charity->street }}</td>
		<td>{{ $user->charity->city }}</td>
		<td>{{ $user->charity->state }}</td>
		<td>{{ $user->charity->zip }}</td>
		<td><button type="button" class="btn btn-default btn-xs">Edit</button></td>
	</tr>
</table>

<!-- name and logo of the charity that is logged in  -->
<div class="col-md-4 text-center v-center">    
	<h2>{{$user->charity->charity_name}}</h2>	
        <img class="img-circle img-responsive" src="{{$user->profile_picture_link}}" alt="{{$user->charity->charity_name}}">
</div>

<div class="col-md-8 text-center v-center">
	<h3>Number of Donators to Charity</h3>
</div>	

@stop

@section('bottomscript')