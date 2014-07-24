@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<div class="basic-login">

				<input type="radio" name="group1" value="3">Donor<br>
				<input type="radio" name="group1" value="4">Charity<br>

				
				<div  id="area-3" class="area">

			        <h1>Donor Registration</h1>
			        {{ Form::open(array('action' => array('HomeController@doRegistration'), 'method' => 'POST')) }}

				    <div>
				        {{ $user->twitter_handle }}<br>
				        {{ Form::hidden('role_id', User::ROLE_DONOR) }}
				    </div>
				    
				    <div>
				        {{ Form::label('first_name', 'First Name') }}
				        {{ Form::text('first_name', Input::old('first_name')) }}
				        {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}<br>
				    </div>
				    <div>
				        {{ Form::label('last_name', 'Last Name') }}
				        {{ Form::text('last_name', Input::old('last_name')) }}
				        {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}<br>
				    </div>
				    <div>
				        {{ Form::label('email', 'Email') }}
				        {{ Form::text('email', Input::old('email')) }}
				        {{ $errors->first('email', '<span class="help-block">:message</span>') }}<br>
				    </div>
				    
				   	{{ Form::Submit('Register', array('class' => 'btn pull-right'))}}
				   	{{ Form::close() }}

				</div>
				
				<div id="area-4"  class="area">

					<h1>Charity Registration</h1>
					{{Form::open(array('action'=> array('HomeController@doRegistration'), 'files' => true, 'method' => 'POST'))  }}

				    <div>
				        {{ $user->twitter_handle }}<br>
				        {{ Form::hidden('role_id', User::ROLE_CHARITY) }}
				    </div>

					<div class="form-group">
					    {{ Form::label('charity_name', 'Charity Name') }}
					    {{ Form::text('charity_name') }}
					   	{{ $errors->first('charity_name', '<span class="help-block">:message</span>') }}<br>
					</div>
					<div class="form-group">
					    {{ Form::label('first_name', 'Contact person First Name') }}
					    {{ Form::text('first_name') }}
					   	<!-- {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('last_name', 'Contact person Last Name') }}
					    {{ Form::text('last_name') }}
					   	<!-- {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('email', 'Email Address') }}
					    {{ Form::text('email') }}
					   	<!-- {{ $errors->first('email', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('phone', 'Phone Number') }}
					    {{ Form::text('phone') }}
					   	<!-- {{ $errors->first('phone', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('street', 'Street Address') }}
					    {{ Form::text('street') }}
					   	<!-- {{ $errors->first('street', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('city', 'City') }}
					    {{ Form::text('city') }}
					   	<!-- {{ $errors->first('city', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('state', 'State') }}
					    {{ Form::text('state') }}
					   	<!-- {{ $errors->first('state', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div class="form-group">
					    {{ Form::label('zip', 'Zip') }}
					    {{ Form::text('zip') }}
					   	<!-- {{ $errors->first('zip', '<span class="help-block">:message</span>') }}<br> -->
					</div class="form-group">
					<div class="form-group">
					    {{ Form::label('tax_id', 'Tax ID #') }}
					    {{ Form::text('tax_id') }}
					   	<!-- {{ $errors->first('tax_id', '<span class="help-block">:message</span>') }}<br> -->
					</div>
					<div>
						{{ Form::label ('image', 'Tax ID upload') }}
    					{{ Form::file('image') }}
    					<br>
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
</div>
				
@stop

@section('bottomscript')

<script>
	$(function(){
	   $("div.area").hide();
	    $("input[type=radio]").click(function(){        
	      var val=$(this).val();
	      $(".area").hide();    
	      $("#area-"+val).show();        
	    });      
	});
</script>

@stop