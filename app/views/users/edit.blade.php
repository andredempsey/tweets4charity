@extends('layouts.master')

@section('topscript')

<link rel="stylesheet" href="/css/slider.css" >
<link rel="stylesheet" href="/css/main.css" >

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
								<img class="img-circle img-responsive" style="width: 75px" src="{{$charity->user->profile_picture_link}}" alt="{{$charity->charity_name}}">
							</div>
							<div class="col-sm-3 col-sm-3">
								<h4>{{$charity->charity_name}}</h4>
							</div>
							<div class="col-sm-4 col-sm-4">
								<input id="slider" class="span2 sliderValue" data-charity="{{$charity->id}}" data-slider-min="0" data-slider-max="100" type="text" value="{{$charity->pivot->allotted_percent}}" data-slider-step="1" name="slider"><br>
							</div>
							{{Form::hidden('charity_id', $charity->id)}}
							<div class="col-sm-1 col-sm-1 text-right">
								<input type="text" id="allotted_percent" name="allotted_percent" data-charity="{{$charity->id}}" class="amount" value="{{$charity->pivot->allotted_percent}}" >
							</div>
							<div class="col-sm-1 col-sm-1"> 
								{{link_to_action('DonorsController@removeCharity', 'Remove', array('charity_id' => $charity->id))}}
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
	<div class="row">
	<h5 class="text-center">Pick a Charity</h5>
		<div class="col-md-3"></div>
			<div class="col-md-6 text-center">	
				<div class="panel panel-default">
					<div class="panel-body">
					    @foreach ($charities as $charity)
						    {{link_to_action('DonorsController@addCharity', 'Add', array('charity_id' => $charity->id))}}<img src="{{$charity->user->profile_picture_link}}" style="height:50px">{{$charity->charity_name}}
					    @endforeach
					</div> <!-- end panel-body -->
				</div> <!-- end panel -->
			<div class="text-left">{{ $charities->links() }}</div> <!-- pagination -->
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
			@foreach ($user->donor->activities as $activity)
			<tr>
				<td class='text-center'>{{$activity->period}}</td>
				<td class='text-center'>{{$activity->tweet_count}}</td>
				<td class='text-center'>{{number_format((float)((($user->donor->amount_per_tweet)*$activity->tweet_count)>$user->donor->monthly_goal?$user->donor->monthly_goal:($user->donor->amount_per_tweet)*$activity->tweet_count)/$activity->tweet_count, 2 ,'.','')}}</td>
				<td class='text-center'>{{(($user->donor->amount_per_tweet)*$activity->tweet_count)>$user->donor->monthly_goal?$user->donor->monthly_goal:($user->donor->amount_per_tweet)*$activity->tweet_count}}</td>
				<td class='text-center'>{{$activity->updated_at}}</td>
				<td><script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
				                data-key="@stripeKey"
				                data-amount="" data-description="Pay my bill"></script></td>
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
				@foreach ($charities as $charity)
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
	</div> <!-- end of container -->
</div>	
@stop

@section('bottomscript')

<script src="/bootstrap-3.2.0/js/jquery.min.js"></script>
<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>
<script src="/js/jquery.als-1.6.min.js"></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

//script to make error or success message disappear after a couple seconds
$('.fade_message').delay(2000).fadeOut(1000);


// set the initial values for the slider controls
$('.amount').each(function(index, amt) {
	var charityId = $(this).data('charity');
	var amtValue = $(this).val();
	var $sliders = $('.sliderValue');
	$sliders.each(function(index, sld) {
		if ($(sld).data('charity') == charityId) {
			
			$(sld).slider('setValue', amtValue);
		}
	});
});


//update amount field with slider value

$('.sliderValue').slider().on('slideStop', function() { 	

 	var slideValue = $(this).slider('getValue').val();  
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

</script>


@stop