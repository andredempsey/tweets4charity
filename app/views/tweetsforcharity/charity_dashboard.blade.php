@extends('layouts.master')

@section('topscript')
@stop

@section('content')
{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}


"you're logged in as of blank"

"#number of twitter users donating to your charity"

"Donation history as of the previous month"

"edit link to update charity "


@stop

@section('bottomscript')