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
			        {{ Form::model($user, array('action' => array('UsersController@store', $user->twitter_handle), 'method' => 'PUT')) }}

				    <div>
				        {{ $user->twitter_handle }}<br>
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


				    <!-- <input type="text" value="123123" id="id1">
				    <input type="text" value="123123" id="id2">
				    <input type="text" value="123123" id="id3"> -->
				
				<div id="area-4"  class="area">
					{{Form::model($user, array('action'=> array('CharitiesController@store', $user->twitter_handle), 'method' => 'PUT'))  }}
					<div class="form-group">
					    {{ Form::label('charity_name', 'Charity Name', array('class' => 'icon-user')) }}
					    {{ Form::text('charity_name', null, array('class' => 'form-control')) }}
					   	{{ $errors->first('charity_name', '<span class="help-block">:message</span>') }}<br>
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
					<div class="form-group">
					    {{ Form::label('tax_id', 'Tax ID #', array('class' => 'icon-user')) }}
					    {{ Form::text('tax_id', null, array('class' => 'form-control')) }}
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