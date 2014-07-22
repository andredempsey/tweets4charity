@extends('layouts.master')

@section('content')
<!-- NRS - added 7/22/12 - redirects to Twitter -->

<body>
<div class="container">

    <div class="row">
       
        <div class="col-md-12 text-center v-center">
          
            <h1 class="h-bold">A Twitter account is required for registration.</h1>
            <p class="lead">As part of our registration process, you will need to log in and allow Tweets for Charity as an authorized application. <br>After you sign in with your Twitter account, you will be redirected back to our page to complete registration. <br></p>
              
            <br><br>
            <form action="/twitter-redirect">
                <input type="submit" value="Sign in with Twitter">
            </form>
      </div> <!-- /row -->
    <br><br><br><br><br>

</div>
@stop