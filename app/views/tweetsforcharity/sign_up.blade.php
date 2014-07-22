@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<div class="basic-login">
				{{Form::open(array('action'=>'CharitiesController@store', 'class' => 'form-signin', 'role' => 'form')) }}
					<div class="form-group">
					    {{ Form::label('role_id', 'Role NUMBER', array('class' => 'icon-user')) }}
					    {{ Form::text('role_id', null, array('class' => 'role_id')) }}
					   	<!-- {{ $errors->first('twitter_handle', '<span class="help-block">:message</span>') }}<br> -->
					</div>

					<div class="form-group">
					    {{ Form::label('twitter_handle', 'Twitter Handle or User Name', array('class' => 'icon-user')) }}
					    {{ Form::text('twitter_handle', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('twitter_handle', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('charity_name', 'Charity Name', array('class' => 'icon-user')) }}
					    {{ Form::text('charity_name', null, array('class' => 'form-control')) }}
					   	{{ $errors->first('charity_name', '<span class="help-block">:message</span>') }}<br>
					</div>
					<div class="form-group">
					    {{ Form::label('tax_id', 'Tax ID #', array('class' => 'icon-user')) }}
					    {{ Form::text('tax_id', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('tax_id', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('first_name', 'Contact person First Name', array('class' => 'icon-user')) }}
					    {{ Form::text('first_name', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('last_name', 'Contact person Last Name', array('class' => 'icon-user')) }}
					    {{ Form::text('last_name', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('email', 'Email Address', array('class' => 'icon-user')) }}
					    {{ Form::text('email', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('email', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('phone', 'Phone Number', array('class' => 'icon-user')) }}
					    {{ Form::text('phone', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('phone', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('street', 'Street Address', array('class' => 'icon-user')) }}
					    {{ Form::text('street', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('street', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('city', 'City', array('class' => 'icon-user')) }}
					    {{ Form::text('city', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('city', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('state', 'State', array('class' => 'icon-user')) }}
					    {{ Form::text('state', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('state', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('zip', 'Zip', array('class' => 'icon-user')) }}
					    {{ Form::text('zip', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('zip', '<span class="help-block">:message</span>') }}<br> -->
					</div class="form-group">
					<div>
						{{ Form::label ('image', 'Tax ID upload') }}
    					{{ Form::file('image') }}
    					<br>
					</div>
					<div class="form-group">
					    {{ Form::label('password', 'Password (min 6 chars)', array('class' => 'icon-lock')) }}
					    <br>
					    {{ Form::password('password', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('password', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('password2', 'Re-enter Password', array('class' => 'icon-lock')) }}
					    <br>
					    {{ Form::password('password2', null, array('class' => 'form-control')) }}
					   	<!-- {{ $errors->first('password2', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div>
				 	{{Form::Submit('Register Charity', array('class' => 'btn pull-right')) }}
					</div>
					<div class="clearfix">
					{{ Form::close() }}
					</div>
			</div>
		</div>
	</div>
</div>				
@stop

@section('bottomscript')
@stop