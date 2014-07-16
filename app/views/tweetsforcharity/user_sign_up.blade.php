@extends('layouts.master')

@section('topscript')
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<div class="basic-login">
				{{Form::open(array('action'=>'UsersController@store', 'class' => 'form-signin', 'role' => 'form'))}}
					<div class="form-group">
						{{Form::label('first_name', 'First Name', array('class' => 'icon-user'))}}
						{{Form::text('first_name', null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('last_name', 'Last Name', array('class' => 'icon-user'))}}
						{{Form::text('last_name', null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('twitter_handle', 'Twitter Handle', array('class' => 'icon-user'))}}
						{{Form::text('twitter_handle', null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('email', 'Email', array('class' => 'icon-user'))}}
						{{Form::text('email', null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password (min 6 chars)', array('class' => 'icon-lock'))}}
						<br>
						{{Form::password('password', null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('password2', 'Re-enter Password', array('class' => 'icon-lock'))}}
						<br>
						{{Form::password('password2', null, array('class' => 'form-control'))}}
					</div>
					{{Form::Submit('Register', array('class' => 'btn pull-right'))}}
					<div class="clearfix"></div>
				{{Form::close()}}
			</div>
		</div>
		<!-- <div class="col-sm-6 col-sm-offset-1 social-login">
			<p>You can use your Facebook or Twitter for registration</p>
			<div class="social-login-buttons">
				<a href="#" class="btn-facebook-login">Use Facebook</a>
				<a href="#" class="btn-twitter-login">Use Twitter</a>
			</div>
		</div> -->
	</div>
</div>
@stop

@section('bottomscript')
@stop