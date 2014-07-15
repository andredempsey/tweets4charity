@extends('layouts.master')

@section('topscript')
@stop

@section('content')
@foreach ($users as $user)

{{{$post->user->twitter_handle}}}
<h3>{{link_to_action('PostsController@show', $post->title, array($post->slug))}}</h3>
<a href="{{action('PostsController@show', array($post->slug))}}" class="btn btn-default"><span class="glyphicon glyphicon-book"></span> Continue Reading</a>
@endforeach


@stop

@section('bottomscript')
@stop