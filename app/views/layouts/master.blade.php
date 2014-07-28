<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tweets for Charity</title>

    <link rel="shortcut icon" href="/favicon.ico">
    <!-- css -->
    <link href="/shuffle/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/shuffle/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/shuffle/css/nivo-lightbox.css" rel="stylesheet" />
    <link href="/shuffle/css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="/shuffle/css/owl.carousel.css" rel="stylesheet" media="screen" />
    <link href="/shuffle/css/owl.theme.css" rel="stylesheet" media="screen" />
    <link href="/shuffle/css/flexslider.css" rel="stylesheet" />
    <link href="/shuffle/css/animate.css" rel="stylesheet" />
    <link href="/shuffle/color/default.css" rel="stylesheet">
    <link href="/shuffle/css/style.css" rel="stylesheet">

    @yield('topscript')
</head>
    <body>


        @if (Session::has('successMessage'))
            <div class="alert alert-success fade_message">{{{ Session::get('successMessage') }}}</div>
        @endif
        @if (Session::has('errorMessage'))
            <div class="alert alert-danger fade_message">{{{ Session::get('errorMessage') }}}</div>
        @endif

        @if (!isset($index))
            @include('partials.navbar')
        @endif

        @yield('topscript')

        @yield('content')

        @if (isset($index))
            @include('partials.navbar')
        @endif

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

        <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              
              <div class="text-center">
                <a href="#" class="totop"><i class="fa fa-angle-up fa-3x"></i></a>

                <p>Tweets for Charity,  a Codeup project<br>
                &copy;Tweets for Charity. <a href="http://www.tweets-for-charity.com">Tweets for Charity</a></p>
              </div>
            </div>
          </div>  
        </div>
      </footer>
    </body>
</html>