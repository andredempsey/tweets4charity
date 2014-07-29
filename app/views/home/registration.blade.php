@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div class="container">
	<div class="row">
	    <button class="register-form-btn" data-value="donor">Donor</button>
		<button class="register-form-btn" data-value="charity">Charity</button>
	</div>

	<div class="clearfix"></div>

	<!-- Donor form -->
	<div id="donor-form" class="row register-form"><br>

		{{ Form::open(array('action' => array('HomeController@doRegistration'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) }}
		  
		  <div>
				{{ Form::hidden('role_id', User::ROLE_DONOR) }}
		  </div>
		  <div class="form-group">
		  	{{ Form::label('first_name', 'First Name', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'placeholder' => 'First Name')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
			</div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email')) }}
		    </div>
		  </div>

		  {{ Form::Submit('Register', array('class' => 'btn col-md-offset-2'))}}
		  {{ Form::close() }}

	</div>

	<div class="clearfix"></div>

	<!-- Charity form -->
	<div id="charity-form" class="row register-form"><br>

		

		<h1>Charity Registration</h1>
		{{Form::open(array('action'=> array('HomeController@doRegistration'), 'files' => true, 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form'))  }}

		<div>
			{{ Form::hidden('role_id', User::ROLE_CHARITY) }}
		 </div>
		 <div>
			<h6>When registering as a charity please complete the form below, an admin at Tweets For Charity will verify and approve you as a valid charity.  Once the form is complete you will be redirected back to our home page, approval takes 2-3 business days.  Thank you!</h6> 
	    </div>
	    <div class="form-group">
		  	{{ Form::label('charity_name', 'Charity Name', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('charity_name', Input::old('charity_name'), array('class' => 'form-control', 'placeholder' => 'Charity Name')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('first_name, 'Contact First Name', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'placeholder' => 'First Name')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('last_name', 'Contact Last Name', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('email', 'Email Address', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('phone', 'Phone Number', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'placeholder' => 'Phone Number')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('street', 'Street Address', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('street', Input::old('street'), array('class' => 'form-control', 'placeholder' => 'Street Address')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('city', 'City', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('city', Input::old('city'), array('class' => 'form-control', 'placeholder' => 'City')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('state', 'State', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('state', Input::old('state'), array('class' => 'form-control', 'placeholder' => 'State')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('zip', 'Zip', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('zip', Input::old('zip'), array('class' => 'form-control', 'placeholder' => 'Zip')) }}
		    </div>
		  </div>

		  <div class="form-group">
		  	{{ Form::label('tax_id', 'Tax ID #', array('class' => 'col-sm-2 control-label')) }}
		    <div class="col-sm-7">
		    	{{ Form::text('tax_id', Input::old('tax_id'), array('class' => 'form-control', 'placeholder' => 'Tax ID #')) }}
		    </div>
		  </div>

		  <div>
		  	{{Form::Submit('Register Charity', array('class' => 'btn col-md-offset-2')) }}
		  </div>	
	<div class="clearfix"></div>	  	
	{{ Form::close() }}
	</div>

</div>			

				
@stop

@section('bottomscript')

<script>
	$(function(){
	   $(".register-form").hide();
	    $(".register-form-btn").click(function(){        
	      var val = $(this).data('value');
	      console.log(val);
	      $(".register-form").hide();    
	      $("#" + val + "-form").fadeIn();      
	    });      
	});
</script>

@stop