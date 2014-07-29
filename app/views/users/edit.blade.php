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
		    <a href="https://twitter.com/{{{ $user->twitter_handle }}}"><img class="img-rounded" src="{{{ $profile_image }}}" height="200px" width="200px"></a>
		</div>   
	</div>
	<div class="row">
	    <div class="col-md-2 col-sm-2">
	    	<h4>{{'@' . $user->twitter_handle}}</h4>
		</div>
	</div>
	<div class="well">
		<table class="font-color table table-hover table-responsive">
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
	<h2 class="font-color">Charities</h2>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default well">
				<div class="panel-body">	
					@foreach ($user->donor->charities as $charity)
					<div class="col-md-12 col-sm-12">
						<!-- Ajax Form -->
						<form id="{{'ajax-update' . $charity->id}}">
							<div class="col-sm-1 col-sm-1">	
								<a href="http://www.twitter.com/{{$charity->user->twitter_handle}}"><img class="img-rounded img-responsive"  src="{{{ str_replace("normal.jpeg", "400x400.jpeg", $charity->user->profile_picture_link) }}}" height="100px" width="100px" alt="{{$charity->charity_name}}"></a>
							</div>
							<div class="col-sm-3 col-sm-3">
								<h4>{{$charity->charity_name}}</h4>
							</div>
							<div class="col-sm-5 col-sm-5">
								<input
									class="span2 sliderValue responsive" name="slider" type="text"
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
				</div> 	<!-- end panel-body -->
			</div> <!-- end panel panel-default well -->
		</div> <!-- end col-md-12 -->
	</div> <!-- end row -->

	<!-- Available Charities Section -->
	<!-- Search Charities -->
	
	<!-- end Search Charities -->
	<div class="row">
		<!-- <div class="col-md-12"></div> -->
		<div class="col-md-12">	
			<div class="panel panel-default well">
			<h5 class="text-left">Add a Charity</h5>
				<div class="panel-body">
					<div class="row">
				    @foreach ($charities as $charity)
					    <div class="col-md-1 text-center">
						    <a href="http://www.twitter.com/{{$charity->user->twitter_handle}}"><img class="img-rounded img-responsive"  src="{{{ str_replace("normal.jpeg", "400x400.jpeg", $charity->user->profile_picture_link) }}}" height="200px" width="200px" alt="{{$charity->charity_name}}"></a>
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
				<div class="well">	
					<h5 class="text-left">Search for a Charity</h5>
	                <div class="col-md-6 input-group">
	                {{ Form::open(array('action'=> array('UsersController@edit', $user->id), 'class' => 'form-inline', 'method' => 'GET')) }}
	                    {{-- Form::label('search', 'Search', array('class' => 'form-label')) --}}
	                    {{ Form::text('charity_search', Input::get('charity_search'), array('placeholder' => 'Search Query', 'class' => 'form-control search_bar')) }}
	                        <button class="btn btn-skin glyphicon glyphicon-search search_bar_btn">
	                        </button>
	                    {{ Form::close() }} 
					</div> <!-- end class="col-md-12" -->
	            </div>
	    </div>
	</div>
	<h2 class="font-color">Activity</h2>
	<div class="row">
		<div class="col-md-12">		
			<div class="panel panel-default well">			
				<table class="font-color table table-hover table table-responsive">
					<tr>
						<th class='text-center'>Month</th>
						<th class='text-center'>Tweet Count</th>
						<th class='text-center'>Pledged/Tweet</th>
						<th class='text-center'>Amount Due ($)</th>
						<th class='text-center'>Date</th>
						<th class='text-center'>Payment</th>
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
							<td><script src="https://checkout.stripe.com/v2/checkout.js" class="button stripe"
							                data-key="pk_test_4Rd5UZ8YI5GylPQvVuFovbj3"
							                data-amount="" data-description="Pay my bill"></script></td>
							@endif
						</tr>
						@endforeach
				</table>
			</div>	<!-- end panel panel-default well -->
		</div> <!-- col-md-12 -->
	</div> <!-- end row -->
</div> <!-- end of container -->
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

$('.sliderValue').slider({
	formater: function(value) {
		return value + " %";
	}
	}).on('slideStop', function(index) {
	 	var endingSlideValue = $(this).slider('getValue');
	 	var charityID = $(this).data('charity');
	 	var startingSlidValue = 0;
		$('.amount').each(function(index, amt) {

			if (charityID  == $(this).data('charity')) {
				// console.log('Found match: ' +  $(sld).slider('getValue').val());
				startingSliderValue = $(amt).value;
				$(amt).val(endingSlideValue);
				adjustSliders(index ,startingSlidValue, endingSlideValue);
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

//update amount field with slider value
function adjustSliders (lastMoved ,startingSlidValue, endingSlideValue) {
//lastMove is charityID of slider that was last moved
//slideValue is the value of that slider
var totalPercent = 0;
var sliderCount = 0;
var autoMoveAmount = 0;
var deltaAmount = 0;

//count number of sliders
$('.amount').each(function() {
			sliderCount++;
	});

//calculate amount to move other sliders
//subtract old value from new value and divide by number of sliders-1
autoMoveAmount = parseInt((100 - parseInt(endingSlideValue))/parseInt(sliderCount-1));

//determine if there is a remainder to add to the last slider
totalPercent = (autoMoveAmount * (sliderCount - 1)) + parseInt(endingSlideValue);
deltaAmount = 100 - totalPercent;

$('.amount').each(function(index, amt) {
		if (index != lastMoved) {
			// add delta to all sliders other than the one last moved
			$(amt).val(parseInt(autoMoveAmount));
		}
		else {
			$(amt).val(parseInt(endingSlideValue) + deltaAmount);
		}
		
		var formValues = $('#ajax-update'+ $(this).data('charity')).serialize();  //serialize all form values for ajax

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

};
// end adjustSliders method


</script>


@stop