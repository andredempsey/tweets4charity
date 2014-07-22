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
            <div class="col-md-12">
                <h1 class="page-header">{{{ $user->twitter_handle }}} <a href="http://www.twitter.com/{{{ $user->twitter_handle }}}"><i class="icon-twitter"></i></a>
                    <small>Charities {{{ $name }}} donates to: </small>
                </h1>
            </div>
            
            <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                data-key="pk_test_4Rd5UZ8YI5GylPQvVuFovbj3"
                data-amount="5000" data-description="Donation amount"></script>
            
            <div class="col-md-12">
                <h2 class="page-header">Charities</h2>
            </div>

        </div>

        <div class="row">
            @foreach ($user->donor->charities as $charity)
            <div class="col-md-4 col-sm-6">
                <img class="img-circle img-responsive" src="http://placehold.it/200x200">
                
                <h3>{{{ $charity->charity_name }}}</h3>
                <!-- <p>Charity Description</p> -->
            </div>
            @endforeach
        </div>
 </div>       

@stop

@section('bottomscript')