@extends('layouts.master')

@section('topscript')
<link href="/bootstrap-3.2.0/css/round-about.css" rel="stylesheet">
@stop

@section('content')
 <div class="container">

        <div class="row">

            <div class="col-md-12">
                <h1 class="page-header">{{{ $user->twitter_handle }}} <a href="http://www.twitter.com/{{{ $user->twitter_handle }}}"><i class="icon-twitter"></i></a>
                    <small>Charities {{{ $user->twitter_handle }}} donates to: </small>
                </h1>
                <!-- <p>This is a great place to start off with a short and sweet description of your company, organization, or whatever purpose your website is serving. Keep it friendly, engaging, but short enough to where you won't lose your reader!</p>
                <p>If you need a bit more space to describe what is going on, we recommend putting a picture in this section. Use the
                    <code>pull-right</code>class on the image to make it look good!</p> -->
            </div>

            <div class="col-md-12">
                <h2 class="page-header">Charities</h2>
            </div>

        </div>

        <div class="row">
            @foreach ($charities as $charity)
            <div class="col-md-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                
                <h3>{{{ $charity->charity_name}}}
                   
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
            @endforeach
            <!-- <div class="col-lg-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                <h3>Charity Two
                    <small>percentage</small>
                </h3>
                <p>Charity Description</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                <h3>Charity Three
                   <small>percentage</small>
                </h3>
                <p>Charity Description</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                <h3>Charity Four
                    <small>percentage</small>
                </h3>
                <p>Charity Description</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                <h3>Charity Five
                    <small>percentage</small>
                </h3>
                <p>Charity Description</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                <h3>Charity Six
                    <small>percentage</small>
                </h3>
                <p>Charity Description</p>
            </div> -->
        </div>
 </div>       

@stop

@section('bottomscript')