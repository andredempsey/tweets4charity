@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div>
<!-- if charity would like to edit the user information  -->
<!-- nneed to chage some of the variables -->
	@if (isset($charity))
	    <h1>Edit Charity</h1>
	    {{ Form::model($charity, array('action' => array('CharitiesController@update', $charity->id), 'method' => 'PUT')) }}
    @else
	    <h1>Create a New Charity</h1>
	    {{ Form::open(array('action'=>'CharitiesController@store')) }}
	@endif

	<div>
	    {{ Form::label('twitter_handle', 'Twitter handle') }}
	    {{ Form::text('twitter_handle', Input::old('twitter_handle')) }}
	   	{{ $errors->first('twitter_handle', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('charity_name', 'Charity name') }}
	    {{ Form::text('charity_name', Input::old('charity_name')) }}
	   	{{ $errors->first('charity_name', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('tax_id', 'Tax ID #') }}
	    {{ Form::text('tax_id', Input::old('tax_id')) }}
	   	{{ $errors->first('tax_id', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('password', 'Password') }}
	    {{ Form::text('password', Input::old('password')) }}
	   	{{ $errors->first('password', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('first_name', 'Contact person first name') }}
	    {{ Form::text('first_name', Input::old('first_name')) }}
	   	{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('last_name', 'Contact person last name') }}
	    {{ Form::text('last_name', Input::old('last_name')) }}
	   	{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('email', 'Email address') }}
	    {{ Form::text('email', Input::old('email')) }}
	   	{{ $errors->first('email', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('phone', 'Phone number') }}
	    {{ Form::text('phone', Input::old('phone')) }}
	   	{{ $errors->first('phone', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('street', 'Street address') }}
	    {{ Form::text('street', Input::old('street')) }}
	   	{{ $errors->first('street', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('city', 'City') }}
	    {{ Form::text('city', Input::old('city')) }}
	   	{{ $errors->first('city', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('state', 'State') }}
	    {{ Form::text('state', Input::old('state')) }}
	   	{{ $errors->first('state', '<span class="help-block">:message</span>') }}<br>
	</div>
	<div>
	    {{ Form::label('zip', 'Zip') }}
	    {{ Form::text('zip', Input::old('zip')) }}
	   	{{ $errors->first('zip', '<span class="help-block">:message</span>') }}<br>
	</div>
	
 	{{ Form::submit('Submit New Post') }}

</div>

	{{ Form::close() }}
@stop

@section('bottomscript')