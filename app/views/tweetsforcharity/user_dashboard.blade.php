@extends('layouts.master')

@section('topscript')

<link rel="stylesheet" href="/css/slider.css" >
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
<div class="row">
	<div class="col-md-1 col-sm-1">
	    <a href="https://twitter.com/{{{ $user->twitter_handle }}}"><img class="img-circle" src="{{{ $user->profile_picture_link }}}" height="100" width="100"></a>
	</div>   
    <div class="col-md-2 col-sm-2">
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
		<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
	</tr>
</table>
{{Form::close()}}
</div>
<!-- end Donor data section -->
<div class="container">

	<!-- Begin Charities section -->
	<h2>Charities</h2>
	<div class="row">
		<div class="col-md-12">
			@foreach ($user->donor->charities as $charity)
			<div class="col-md-12 col-sm-12">	
			<!-- Ajax Form -->
			<form class="ajax-update">
				{{Form::hidden('user_id', $user->id)}}
				<div class="col-md-1 col-sm-1">	
					<img class="img-circle img-responsive" style="width: 75px" src="{{$charity->user->profile_picture_link}}" alt="{{$charity->charity_name}}">
				</div>
				<div class="col-md-2 col-sm-2">
					<h4>{{$charity->charity_name}}</h4>
				</div>
				<div class="col-md-7 col-sm-7">
					<input id="slider" class="span2 sliderValue" data-slider-max="100" type="text" value = {{$charity->pivot->allotted_percent}} name="slider"><br>
				</div>
				{{Form::hidden('charity_id', $charity->id)}}
				<div class="col-md-1 col-sm-1">
					<input type="text" id="alloted_percent" name="alloted_percent" class="amount" value="{{$charity->pivot->allotted_percent}}" >
				</div>
				<div class="col-md-1 col-sm-1"> <input type="submit"></div>
				<div class="col-md-1 col-sm-1"> 
					{{link_to_action('HomeController@addCharity', 'Remove', array('attach_to_user_id' => $user->id, 'charity_id' => $charity->id))}}
				</div>
			</form>
			<!--end Ajax Form -->
			</div> <!-- end class="col-md-12 col-sm-12" -->
			@endforeach
		</div> <!-- end charities section -->
	</div> <!-- end row -->
	<!-- Available Charities Section -->
	<div class="row">
		<div class="col-md-12 center-text">
		<h4>Available Charities</h4>
		<!-- <form action=""></form> -->
		{{ Form::model($user->donor->charities, array('action' => array('HomeController@addCharity'), 'method' => 'GET')) }}
	    @foreach ($charities as $charity)
		    <span>{{link_to_action('HomeController@addCharity', 'Add', array('attach_to_user_id' => $user->id, 'charity_id' => $charity->id))}}<img src="{{$charity->user->profile_picture_link}}" style="height:50px">{{$charity->charity_name}}</span>
	    @endforeach
		</div> <!-- end class="col-md-12" -->
	</div>	<!-- end Available Charities Section -->
	<div class="text-left">{{ $charities->links() }}</div> <!-- pagination -->
		{{Form::close()}}











	<!-- ***************HOLD FOR POSSIBLE FUTURE INTEGRATION -->
	<!-- Any List Scroller Plug In -->
	<!-- <div class="well well-lg">
	{{ Form::model($user->donor->charities, array('action' => array('HomeController@addCharity'), 'method' => 'GET')) }}
	<div class="als-container" id="pickList">
	  <span class="als-prev"><img src="/img/thin_left_arrow_333.png" alt="prev" title="previous" /></span>
	  <div class="als-viewport">
	    <ul class="als-wrapper">
		@foreach ($charities as $charity)
	      <li class="als-item"><img src="/img/fragola.png">Strawberry</li>
	    @endforeach
	    </ul>
	  </div>
	  <span class="als-next"><img src="/img/thin_right_arrow_333.png" alt="next" title="next" /></span>
	</div>
	{{Form::close()}}
	</div> -->
	<!-- Any List Scroller Plug In -->
	<!-- end Available Charities Section -->
	<!-- *******************end HOLD FOR POSSIBLE FUTURE INTEGRATION -->
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
@stop

@section('bottomscript')

<script src="/bootstrap-3.2.0/js/jquery.min.js"></script>
<script src="/bootstrap-3.2.0/js/bootstrap-slider.js"></script>
<script src="/js/jquery.als-1.6.min.js"></script>

<script>

$("#pickList").als({
	visible_items: 5,
	scrolling_items: 1,
	orientation: "horizontal",
	circular: "yes",
	autoscroll: "no",
	interval: 2000
});

$('.sliderValue').slider().on('slideStop', function() {
 	
 	var numberOfSliders =  $(":input[id^=alloted_percent]").length;
	console.log($(this).slider('getValue').val());
	var formValues = $(this).serialize();
	console.log(formValues);
});

$('.ajax-update').on('submit', function (e) {
    e.preventDefault();
    var formValues = $(this).serialize();
    console.log($('#allotted_percent').val());
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



</script>


@stop