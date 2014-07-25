@extends('layouts.master')

@section('topscript')
<!-- <link href="/bootstrap-3.2.0/css/round-about.css" rel="stylesheet"> -->
@stop

@section('content')
 <div class="container">

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/{{{ $user->twitter_handle }}}"><img class="img-circle" src="{{{ str_replace("normal.jpeg", "400x400.jpeg", $profile_image) }}}" height="200" width="200"></a><!-- <a href="http://www.twitter.com/210AxS"><i class="icon-twitter"></i></a> -->
            </div>    
            @if(Auth::user()->role_id == User::ROLE_DONOR)
                <div class="col-md-12">
                    <h2 class="page-header">@{{{ $user->twitter_handle }}} <a href="http://www.twitter.com/{{{ $user->twitter_handle }}}"><i class="icon-twitter"></i></a><br>
                        <small> {{{ $name }}} donates to: </small>
                    </h2>
                </div>            
            <div class="col-md-12">
                <h2 class="page-header">Charities</h2>
            </div>

            <div class="row">
                @if ($user->donor) 
                    @foreach ($user->donor->charities as $charity)
                    <div class="col-md-4 col-sm-6">
                        <img class="img-circle img-responsive" style="height: 100px" src="{{ $charity->user->profile_picture_link }}">
                        <a href="http://www.twitter.com/{{$charity->user->twitter_handle}}">{{$charity->charity_name}}</a></h5>
                        <!-- <p>Charity Description</p> -->
                    </div>
                    @endforeach
                @endif
            </div>

            @elseif(Auth::user()->role_id == User::ROLE_CHARITY)
                <div class="col-md-12">
                    <h1>Number of users donating to {{{ $user->charity->charity_name }}}</h1>
                    <h2>{{{ $user->charity->donors->count() }}}
             @endif       

 </div>       

@stop

@section('bottomscript')