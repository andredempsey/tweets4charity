@extends('layouts.master')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center v-center">

            <h1 class="h-bold">A Twitter account is required for registration.</h1>
            <p class="lead">As part of our registration process, you will need to log in and allow Tweets for Charity as an authorized application. <br>After you sign in with your Twitter account, you will be redirected back to our page to complete registration. <br></p>

            <br><br>
            <a href="{{ action('HomeController@showLogin') }}" class="btn btn-primary btn-lg">Sign in with Twitter</a>
        </div>
    </div>
    <br><br><br><br><br>

</div>
@stop