@extends('layouts.master')

@section('topscript')
@stop

@section('content')

<div>
<!-- if charity would like to edit the user information  -->
<!-- nneed to chage some of the variables -->
    @if (isset($user))
        <h1>Edit your account</h1>
        {{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
    @else
        <h1>New User Registration</h1>
        {{ Form::open(array('action'=>'UsersController@store')) }}
    @endif

    <div>
        {{ Form::label('twitter_handle', 'Twitter handle') }}
        {{ Form::text('twitter_handle', Input::old('twitter_handle')) }}
        {{ $errors->first('twitter_handle', '<span class="help-block">:message</span>') }}<br>
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
    
    {{ Form::submit('Submit New Post') }}

</div>

    {{ Form::close() }}
@stop

@section('bottomscript')