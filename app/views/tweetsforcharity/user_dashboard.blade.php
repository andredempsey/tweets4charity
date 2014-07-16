@extends('layouts.master')

@section('topscript')
@stop

@section('content')
{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
<table class="table table-hover table-striped table-responsive">
	<tr>
		<th>{{Form::label('twitterhandle','Twitter Handle')}}</th>
		<th>{{Form::label('firstname','First Name')}}</th>
		<th>{{Form::label('lastname','Last Name')}}</th>
		<th>{{Form::label('Email','Email')}}</th>
		<th>{{Form::label('amountpertweet','Amount/Tweet')}}</th>
		<th>{{Form::label('reportfrequency','Report Frequency')}}</th>
		<th>{{Form::label('maxcontribution','Max Contribution')}}</th>
		<th>Action</th>
	</tr>

<tr>
	<td>{{Form::text('twitterhandle', $user->twitter_handle, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('firstname', $user->first_name, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('lastname', $user->last_name, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('Email', $user->email, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('amountpertweet', $user->amount_per_tweet, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('reportfrequency', $user->report_frequency, array('class' => 'form-control'))}}</td>
	<td>{{Form::text('maxcontribution', $user->monthly_goal, array('class' => 'form-control'))}}</td>
	<td>{{Form::Submit('Update', array('class' => 'btn btn-default form-group', 'id' => 'submit'))}}</td>
</tr>
</table>
	{{Form::close()}}
{{ Form::model($user->charities, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
<table class="table table-hover table-striped table-responsive">
	<tr>
		<th>{{Form::label('charityname','Charity')}}</th>
		<th>{{Form::label('allotedpercent','Percent')}}</th>
		<th>Action</th>

	</tr>
	@foreach ($user->charities as $charity)
	<tr>
		<td>{{Form::select('charityname', ['Charity1', 'Charity2', 'Charity3','Charity4', 'Charity5', 'Charity6','Charity7', 'Charity8', 'Charity9', 
		'Charity10'], $charity->charity_name, array('class' => 'form-control'))}}</td>
		<td>{{Form::text('allotedpercent', $charity->pivot->alloted_percent, array('class' => 'form-control'))}}</td>
		<td>{{Form::Submit('Remove', array('class' => 'btn btn-danger form-group', 'id' => 'remove'))}}</td>
	</tr>
@endforeach
<td>{{Form::Submit('Add Charity', array('class' => 'btn btn-success form-group', 'id' => 'new'))}}</td>
</table>
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
@stop