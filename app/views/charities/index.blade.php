@extends('layouts.master')

@section('topscript')
<!-- <link href="/bootstrap-3.2.0/css/round-about.css" rel="stylesheet"> -->
@stop

@section('content')
 <div class="container">
    
    <div class="col-md-12">
        <h2 class="page-header">Our Registered Charities</h2>
    </div>

</div>

<div class="row">

    @foreach ($charities as $charity)
    <div class="col-md-4 col-sm-6">
        <a href="www.twitter.com/{{{ $charity->user->twitter_handle }}}" class="img-circle img-responsive" src="{{{ $charity->user->profile_picture_link }}}" >
        <h1>{{{ $charity->charity_name }}}</h1>
        <h3>{{{ $charity->twitter_handle }}}</h3>
    </div>
    @endforeach
</div>
 </div>       

@stop

@section('bottomscript')