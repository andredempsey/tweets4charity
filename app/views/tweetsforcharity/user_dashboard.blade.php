@extends('layouts.master')

@section('topscript')

<script src="/bootstrap-3.2.0/js/jquery.min.js"></script>
<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>
<link rel="stylesheet" href="/bootstrap-3.2.0/css/slider.css" >

@stop

@section('content')
<div class="container-fluid">
<!-- checking/displaying errors based on validation rules in User model -->
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
<!-- end error display section -->

<!-- Donor information that can be edited by user -->
<div class="container">
{{ Form::model($user, array('action' => array('UsersController@update', $user->twitter_handle), 'method' => 'PUT')) }}
<div class="row">
	<div class="col-md-1 col-sm-1">
	    <a href="https://twitter.com/{{{ $user->twitter_handle }}}"><img class="img-circle" src="{{{ $user->profile_picture_link }}}" height="100" width="100"></a>
	</div>   
    <div class="col-md-2 col-sm-2">
	    <h2>{{{Auth::user()->twitter_handle}}}</h2>
	</div>
	
</div>
<div class="row">
	<table class="table table-hover table-striped table-responsive">
	<tr>
		<th>{{Form::label('first_name','First Name')}}</th>
		<th>{{Form::label('last_name','Last Name')}}</th>
		<th>{{Form::label('email','Email')}}</th>
		<th>{{Form::label('amount_per_tweet','Amount/Tweet', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('report_frequency','Report Frequency', array('class' => 'text-center'))}}</th>
		<th>{{Form::label('monthly_goal','Max Contribution', array('class' => 'text-center'))}}</th>
		<th>Action</th>
	</tr>
	<tr>
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
			    <div>{{link_to_action('HomeController@addCharity', 'Add', array('attach_to_user_id' => $user->id, 'charity_id' => $charity->id))}}<img src="{{$charity->user->profile_picture_link}}" style="height:50px">{{$charity->charity_name}}</div>
		    @endforeach
		    <div class="text-left">{{ $charities->links() }}</div>
			{{Form::close()}}
		</div>
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
						<img class="img-circle img-responsive" style="width: 75px" src="{{$charity->user->profile_picture_link}}" alt="{{$charity->charity_name}}">
					</div>
					<div class="col-md-2 col-sm-2">
						<h4>{{$charity->charity_name}}</h4>
					</div>

					<div class="col-md-5 col-sm-2">
						{{Form::text('slider', $charity->pivot->allotted_percent, array('class' => "span2 sliderValue", 'data-slider-max' => "100"))}}  
					</div>
					<!-- <div class="col-md-1 col-sm-1">
						{{Form::text('allotted_percent', $charity->pivot->allotted_percent)}}
					</div> -->
					<div class="col-sm-2 col-sm-1 pull-right">
					{{Form::submit('Remove', array('class' => 'btn btn-danger form-group btnRemove', 'id' => 'remove'))}}
					</div>
				</div>
			{{Form::close()}}
			@endforeach
		</div>	<!-- end charities section -->
	</div>  <!-- end grid col-md-12 -->
</div> <!-- end row -->

<div class="row">
	<h2 class="page-header">Twitter Activity</h2>
</div>
<div class="row">
	<table class="table table-hover table-striped table-responsive">
		<tr>
			<th class='text-center'>Month</th>
			<th class='text-center'>Tweet Count</th>
			<th class='text-center'>Pledged/Tweet</th>
			<th class='text-center'>Amount Due ($)</th>
			<th class='text-center'>Date</th>
			<th></th>
		</tr>
		@foreach ($user->donor->activities as $activity)
		<tr>
			<td class='text-center'>{{$activity->period}}</td>
			<td class='text-center'>{{$activity->tweet_count}}</td>
			<td class='text-center'>{{number_format((float)((($user->donor->amount_per_tweet)*$activity->tweet_count)>$user->donor->monthly_goal?$user->donor->monthly_goal:($user->donor->amount_per_tweet)*$activity->tweet_count)/$activity->tweet_count, 2 ,'.','')}}</td>
			<td class='text-center'>{{(($user->donor->amount_per_tweet)*$activity->tweet_count)>$user->donor->monthly_goal?$user->donor->monthly_goal:($user->donor->amount_per_tweet)*$activity->tweet_count}}</td>
			<td class='text-center'>{{$activity->updated_at}}</td>
			<td><script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
			                data-key="@stripeKey"
			                data-amount="5000" data-description="Pay my bill"></script></td>
		</tr>
		@endforeach
	</table>
</div><!-- end of row -->

<div class="row">
	<h2 class="page-header">Transaction History</h2>
</div>
<div class="row">
	<table class="table table-hover table-striped table-responsive">
		<tr>
			<th class='text-center'>Month</th>
			<th class='text-center'>Amount ($)</th>
			<th class='text-center'>Transaction Date</th>
		</tr>
		@foreach ($user->donor->transactions as $transaction)
		<tr>
			<td class='text-center'>{{date_format($transaction->created_at,'M')}}</td>
			<td class='text-center'>{{number_format((float)($transaction->amount), 2 ,'.','')}}</td>
			<td class='text-center'>{{$transaction->created_at}}</td>
		</tr>
		@endforeach
	</table>
</div><!-- end of row -->

<div class="row">
	<h2 class="page-header">Charity Distribution History</h2>
</div>
<div class="row">
	<table class="table table-hover table-striped table-responsive">
		<tr>
			<th class='text-center'>Month</th>
			<th class='text-center'>Charity</th>
			<th class='text-center'>Amount ($)</th>
			<th class='text-center'>Distribution Date</th>
			<th class='text-center'>Check Sent?</th>
		</tr>
		@foreach ($user->donor->charities as $charity)
		<tr>
			<td class='text-center'></td>
			<td class='text-center'>{{$charity->charity_name}}</td>
			<td class='text-center'></td>
			<td class='text-center'></td>
			<td class='text-center'></td>
		</tr>
		@endforeach
	</table>
</div><!-- end of row -->

>>>>>>> master
</div>
@stop

@section('bottomscript')
<script>

<script>

$('#ajax-add').on('submit', function (e) {
    e.preventDefault();
    var formValues = $(this).serialize();
    console.log(formValues);

    $.ajax({
        url: "/ajax",
        type: "POST",
        data: formValues,
        dataType: "json",
        success: function (data) {
            $('#ajax-message').html(data.message);
        }
    });
});

$('#ajax-delete').on('submit', function (e) {
    e.preventDefault();
    var formValues = $(this).serialize();
    console.log(formValues);

    $.ajax({
        url: "/ajax",
        type: "POST",
        data: formValues,
        dataType: "json",
        success: function (data) {
            $('#ajax-message').html(data.message);
        }
    });
});

$('#ajax-update').on('submit', function (e) {
    e.preventDefault();
    var formValues = $(this).serialize();
    console.log(formValues);

    $.ajax({
        url: "/ajax",
        type: "POST",
        data: formValues,
        dataType: "json",
        success: function (data) {
            $('#ajax-message').html(data.message);
        }
    });
});

$('.sliderValue').slider().on('slideStop', function() {
 	console.log ($(this).slider('getValue').val()); 	 
 });
</script>


@stop