<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tweets for Charity</title>
    
    <!-- css -->
    <link href="/shuffle/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/shuffle/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/shuffle/css/nivo-lightbox.css" rel="stylesheet" />
    <link href="/shuffle/css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="/shuffle/css/owl.carousel.css" rel="stylesheet" media="screen" />
    <link href="/shuffle/css/owl.theme.css" rel="stylesheet" media="screen" />
    <link href="/shuffle/css/flexslider.css" rel="stylesheet" />
    <link href="/shuffle/css/animate.css" rel="stylesheet" />
    <link href="/shuffle/css/style.css" rel="stylesheet">
    <link href="/shuffle/color/default.css" rel="stylesheet">

</head>

    <body>
    <!-- Navigation -->
    
     <div id="navigation">
        <nav class="navbar navbar-custom" role="navigation">
              <div class="container">
                    <div class="row">
                          <div class="col-md-4">
                                   <div class="site-logo">
                                            <a href="/" class="brand">Tweets for Charity</a>
                                    </div>
                          </div>
                          

                          <div class="col-md-8">
         
                                      <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                                <i class="fa fa-bars"></i>
                                </button>
                          </div>
                                      <!-- Collect the nav links, forms, and other content for toggling -->
                                      <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
                                            <ul class="nav navbar-nav">
                                                <!-- NRS- refactored 7/19/14 - made check for if logged in show log out button, if not logged in show register and log in -->
                                                @if (Auth::check())
                                                    <li class="right">
                                                        <!-- <a href="{{ action('UsersController@edit', $user->twitter_handle) }}">Edit</a></li> -->
                                                    <li class-"right"><a href="{{ action('HomeController@logout') }}">Logout</a></li>
                                                @else
                                                    <li class="right"><a href="{{ action('HomeController@showPreLogin') }}">Login/Sign up</a></li>
                                                @endif    
                                           </ul>
                                        </div>
                 <!-- /.Navbar-collapse -->
             
                          </div>
                    </div>
              </div>
              <!-- /.container -->
        </nav>
    </div> 
        
        @if (Session::has('successMessage'))
            <div class="alert alert-success fade_message">{{{ Session::get('successMessage') }}}</div>
        @endif
        @if (Session::has('errorMessage'))
            <div class="alert alert-danger fade_message">{{{ Session::get('errorMessage') }}}</div>
        @endif
        @yield('topscript')
        @yield('content')
        
        @yield('content2')


    <!-- Core JavaScript Files -->
        <script src="/shuffle/js/jquery.min.js"></script>   
        <script src="/shuffle/js/bootstrap.min.js"></script>
        <script src="/shuffle/js/jquery.sticky.js"></script>
        <script src="/shuffle/js/jquery.flexslider-min.js"></script>
        <script src="/shuffle/js/jquery.easing.min.js"></script> 
        <script src="/shuffle/js/jquery.scrollTo.js"></script>
        <script src="/shuffle/js/jquery.appear.js"></script>
        <script src="/shuffle/js/stellar.js"></script>
        <script src="/shuffle/js/wow.min.js"></script>
        <script src="/shuffle/js/owl.carousel.min.js"></script>
        <script src="/shuffle/js/nivo-lightbox.min.js"></script>
        <script src="/shuffle/js/custom.js"></script>
        <script>
            //script to make error or success message disappear after a couple seconds
            $('.fade_message').delay(2000).fadeOut(1000);
        </script>
        
        @yield('bottomscript')
    </body>
</html>