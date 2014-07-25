@extends('layouts.master')

@section('topscript')
<!-- <link href="/bootstrap-3.2.0/css/round-about.css" rel="stylesheet"> -->
@stop

@section('content')
 <div class="container">
    
    <div class="col-md-12">
        <h2 class="page-header">Our Registered Charities</h2>
    </div>

<div class="row">

    @foreach ($charities as $charity)
    <div class="col-md-4 col-sm-6">

        <img src="{{$charity->user->profile_picture_link}}" height="80px" width="80px">
        <h5>
        <a href="http://www.twitter.com/{{$charity->user->twitter_handle}}">{{$charity->charity_name}}</a></h5>
    </div>
    @endforeach

 </div>     
    <div class="row">
        <div class="col-md-12 text-center">{{ $charities->links() }}</div> <!-- pagination -->
    </div> <!-- end row -->
</div>  

@stop

@section('bottomscript')