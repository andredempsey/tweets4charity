@extends('layouts.master')

@section('topscript')

<link rel="stylesheet" href="/css/slider.css" >

<style type="text/css">
.slider.slider-horizontal {
	width: 400px;
}
</style>

<meta name="csrf-token" content="{{{ csrf_token() }}}">

@stop

@section('content')

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
	    <a href="https://twitter.com/{{{ $user->twitter_handle }}}"><img class="img-circle" src="{{{ $profile_image }}}" height="100px" width="100px"></a>
	</div>   
</div>
<div class="row">
    <div class="col-md-2 col-sm-2">
    	<h4>{{'@' . $user->twitter_handle}}</h4>
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
		<td>{{Form::text('first_name', $user->first_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('last_name', $user->last_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('email', $user->email, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('amount_per_tweet', $user->donor->amount_per_tweet, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('report_frequency', $user->donor->report_frequency, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::text('monthly_goal', $user->donor->monthly_goal, array('class' => 'form-control text-center'))}}</td>
		<td>{{Form::Submit('Update', array('class' => "btn btn-skin btn-md", 'id' => 'submit'))}}</td>
	</tr>
</table>
{{Form::close()}}
</div>
<!-- end Donor data section -->
	<!-- Begin Charities section -->
	<h2>Charities</h2>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">	
					@foreach ($user->donor->charities as $charity)
					<div class="col-md-12 col-sm-12">
						<!-- Ajax Form -->
						<form id="{{'ajax-update' . $charity->id}}">
							<div class="col-sm-1 col-sm-1">	
								<a href="http://www.twitter.com/{{$charity->user->twitter_handle}}"><img class="img-circle img-responsive"  src="{{$charity->user->profile_picture_link}}" height="100px" width="100px" alt="{{$charity->charity_name}}"></a>
							</div>
							<div class="col-sm-3 col-sm-3">
								<h4>{{$charity->charity_name}}</h4>
							</div>
							<div class="col-sm-5 col-sm-5">
								<input
									class="span2 sliderValue" name="slider" type="text"
									value="{{$charity->pivot->allotted_percent}}"
									data-charity="{{$charity->id}}"
									data-slider-min="0"
									data-slider-max="100"
									data-slider-step="1">
							</div>
							<div class="col-sm-2 col-sm-2">
								{{Form::hidden('charity_id', $charity->id)}}
								<div class="input-group">
								<input
									class="amount text-right form-control" name="allotted_percent"
									type="text"
									value="{{$charity->pivot->allotted_percent}}"
									data-charity="{{$charity->id}}">
									<span class="input-group-addon">%</span>
								</div>
							</div>
							<div class="col-sm-1 col-sm-1"> 
								{{link_to_action('DonorsController@removeCharity', 'Remove', array('charity_id' => $charity->id), array('class' => "btn btn-skin"))}}
							</div>
						</form>
						<!--end Ajax Form -->
					</div> <!-- end class="col-md-12 col-sm-12" -->
					@endforeach
				</div>
			</div>
		</div> <!-- end charities section -->
	</div> <!-- end row -->

	<!-- Available Charities Section -->
	<!-- Search Charities -->
	
	<!-- end Search Charities -->
	<div class="row">
		<h5 class="text-center">Pick a Charity</h5>
			<div class="col-md-12"></div>
				<div class="col-md-12 text-center">	
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
						    @foreach ($charities as $charity)
							    <div class="col-md-1 text-center">
								    <a href="http://www.twitter.com/{{$charity->user->twitter_handle}}"><img class="img-circle img-responsive"  src="{{$charity->user->profile_picture_link}}" height="100px" width="100px" alt="{{$charity->charity_name}}"></a>
								    {{link_to_action('DonorsController@addCharity','Add', array('charity_id' => $charity->id))}}<span> </span>{{$charity->charity_name}}
							    </div>
							    <div class="col-md-1"></div>
						    @endforeach
							</div> <!-- end row -->
						</div> <!-- end panel-body -->
					</div> <!-- end panel -->
					<div class="row">
						<div class="col-md-12 text-center">{{ $charities->links() }}</div> <!-- pagination -->
					</div> <!-- end row -->
		</div> <!-- end class="col-md-12" -->
	<div class="col-md-3"></div>

	</div>	<!-- end Available Charities Section -->

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
				@foreach ($activities as $activity)
				<tr>
					<td class='text-center'>{{$activity['period']}}</td>
					<td class='text-center'>{{$activity['tweet_count']}}</td>
					<td class='text-center'>
						@if ($activity['tweet_count'] != 0)
								${{number_format((float)((($user->donor->amount_per_tweet) * $activity['tweet_count']) > $user->donor->monthly_goal?
									$user->donor->monthly_goal:
									($user->donor->amount_per_tweet) * $activity['tweet_count'])/$activity['tweet_count'], 2 ,'.','')}}
						@else
							${{$user->donor->amount_per_tweet}}
						@endif
					</td>
					<td class='text-center'>
						{{(($user->donor->amount_per_tweet)*$activity['tweet_count']) > $user->donor->monthly_goal
							?$user->donor->monthly_goal:
							($user->donor->amount_per_tweet)*$activity['tweet_count']}}
					</td>
					<td class='text-center'>{{$activity['updated_at']}}</td>
					@if ($activity['is_paid'])
						<td>Paid</td>
					@else
					<td><script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
					                data-key="pk_test_4Rd5UZ8YI5GylPQvVuFovbj3"
					                data-amount="" data-description="Pay my bill"></script></td>
					@endif
				</tr>
				@endforeach
		</table>
	</div><!-- end of row -->
	</div> <!-- end of container -->
</div>	
@stop

@section('bottomscript')

<script src="/bootstrap-3.2.0/js/jquery.min.js"></script>
<script src="/js/bootstrap-slider.js"></script>
<script src="/js/jquery.als-1.6.min.js"></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

//script to make error or success message disappear after a couple seconds
$('.fade_message').delay(2000).fadeOut(1000);
$('#ajax-message').delay(2000).fadeOut(1000);

//update amount field with slider value

$('.sliderValue').slider({
	formater: function(value) {
		return value + " %";
	}
}).on('slideStop', function() {
 	var slideValue = $(this).slider('getValue');
 	var charityID = $(this).data('charity');
	
	$('.amount').each(function(index, amt) {
		if (charityID  == $(this).data('charity')) {
			// console.log('Found match: ' +  $(sld).slider('getValue').val());
			$(amt).val(slideValue);
		}
	});
	
	var formValues = $('#ajax-update'+charityID).serialize();  //serialize all form values for ajax

	console.log(formValues);  //verify it works

	//pass data to ajax request to update database
    $.ajax({
        url: "/allocation",
        type: "POST",
        data: formValues,
        dataType: "json",
        success: function (data) {
        $('#ajax-message').html(data.message);
        }
	});
});

// set the initial values for the slider controls
$('.amount').each(function(index, amt) {
	var charityId = $(this).data('charity');
	var amtValue = $(this).val();
	var $sliders = $('.sliderValue');
	$sliders.each(function(index, sld) {
		if ($(sld).data('charity') == charityId) {

			$(sld).slider('setValue', parseInt(amtValue, 10));
		}
	});
});

</script>


@stop