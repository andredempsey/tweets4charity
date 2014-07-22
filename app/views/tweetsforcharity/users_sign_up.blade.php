@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div>
<!-- if charity would like to edit the user information  -->
<!-- nneed to chage some of the variables -->
   
        <h1>New User Registration</h1>
        {{ Form::model($user, array('action' => array('HomeController@registration', $user->twitter_handle), 'method' => 'PUT')) }}

    <div>
        {{  $user->twitter_handle }}<br>
    </div>
    <div>
        {{ Form::label('password', 'Create New Password') }}
        {{ Form::text('password', Input::old('password')) }}
        {{ $errors->first('password', '<span class="help-block">:message</span>') }}<br>
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
    
   {{Form::Submit('Register', array('class' => 'btn pull-right'))}}

</div>

    {{ Form::close() }}
@stop

@section('bottomscript')