@extends('layouts.master')

@section('topscript')
<!-- <link href="/bootstrap-3.2.0/css/round-about.css" rel="stylesheet"> -->
@stop

@section('content')
<style>
.img-circle {
    border-radius: 20%;
}
</style>
 <div class="container">

        <div class="row">

            <!-- <div class="col-md-12"> -->
    
                <!-- <h1 class="page-header"> -->
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/210axs"><img class="img-circle" src="https://pbs.twimg.com/profile_images/489488176373694464/ePxtDPCE.jpeg" height="200" width="200"></a><!-- <a href="http://www.twitter.com/210AxS"><i class="icon-twitter"></i></a> -->
                <!-- </h1> -->
                <!-- <p>This is a great place to start off with a short and sweet description of your company, organization, or whatever purpose your website is serving. Keep it friendly, engaging, but short enough to where you won't lose your reader!</p>
                <p>If you need a bit more space to describe what is going on, we recommend putting a picture in this section. Use the
                    <code>pull-right</code>class on the image to make it look good!</p> -->
            </div>

            <!-- <div class="col-md-12"> -->
            <!-- </div> -->
        </div>
        <div class="row">
            <h2 class="page-header">Charities @210AxS donates to: </h2>
                    <!-- <small></small> -->
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/feedthechildren"><img class="img-circle" src="https://pbs.twimg.com/profile_images/478391206590681089/2Xlbt28m.png" height="200" width="200"></a>
                <h3>Feed the Children
                    <small>20%</small>
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
        
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/ASPCA"><img class="img-circle" src="https://pbs.twimg.com/profile_images/1479082848/speech-bubble-2color-180x180.png" height="200" width="200"></a>
                <h3>ASPCA
                    <small>20%</small>
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/safoodbank"><img class="img-circle" src="https://pbs.twimg.com/profile_images/378800000534899092/8589f5bf158c0188c27ef671dc305948.jpeg" height="200" width="200"></a>
                <h3>San Antonio Food Bank
                   <small>20%</small>
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/YMCAsatx"><img class="img-circle" src="https://pbs.twimg.com/profile_images/1909434507/green_logo.jpg" height="200" width="200"></a>
                <h3>YMCA of San Antonio
                    <small>20%</small>
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="https://twitter.com/Silver_BlackCR"><img class="img-circle" src="https://pbs.twimg.com/profile_images/486309418120642560/9zkbXKpB.jpeg" height="200" width="200"></a>
                <h3>Silver and Black Give Back
                    <small>20%</small>
                </h3>
                <!-- <p>Charity Description</p> -->
            </div>
           <!--  <div class="col-lg-4 col-sm-6">
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