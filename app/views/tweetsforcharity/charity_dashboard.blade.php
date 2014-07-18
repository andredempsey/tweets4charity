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
		<td>{{ $twitter_handle }}</td>
		<td>{{ $charity_name }}</td>
		<td>{{ $tax_id }}</td>
		<td>{{ $email }}</td>
		<td>{{ $phone }}</td>
		<td>{{ $street }}</td>
		<td>{{ $city }}</td>
		<td>{{ $state }}</td>
		<td>{{ $zip }}</td>
		<td><button type="button" class="btn btn-default btn-xs">Edit</button></td>
	</tr>
</table>

<!-- name and logo of the charity that is logged in  -->
<div class="col-md-4 text-center v-center">    
	<h2>{{$charity->charity_name}}</h2>	
        <img class="img-circle img-responsive" src="{{$charity->profile_picture_link}}" alt="{{$charity->charity_name}}">
</div>

<div class="col-md-8 text-center v-center">
	<h3>Number of Donators to Charity</h3>
</div>	

@stop

@section('bottomscript')