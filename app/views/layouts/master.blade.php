<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tweets for Charity</title>

    <script src="/bootstrap-3.2.0/js/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/bootstrap-3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="/bootstrap-3.2.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="css" href="/bootstrap-3.2.0/css/demo.css"/>
    <link rel="stylesheet" href="/bootstrap-3.2.0/css/carousel.css" > -->

    <!-- Latest compiled and minified JavaScript -->

    <style>
        body {
            padding-top: 85px;
            padding-left: 85px;
            padding-right:85px;
        }
        
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Navigation Bar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tweets for Charity</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
                <ul class="nav navbar-nav">

                    <li class="{{ Request::is('users_sign_up') ? 'active' : '' }}"><a href="/users_sign_up">Donor Sign Up</a>
                    </li>
                    <li class="{{ Request::is('charities_sign_up') ? 'active' : '' }}"><a href="/charities_sign_up">Charities Sign Up</a>
                    </li>
                    @if (Auth::check())
                        <li class-"right"><a href="{{ action('HomeController@logout') }}">Logout</a></li>
                    @else
                        <li class="right"><a href="{{ action('HomeController@showLogin') }}">Login</a></li>
                    @endif    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
</nav> 

    <body>
        @yield('topscript')
        @if (Session::has('successMessage'))
            <div class="alert alert-success fade_message">{{{ Session::get('successMessage') }}}</div>
        @endif
        @if (Session::has('errorMessage'))
            <div class="alert alert-danger fade_message">{{{ Session::get('errorMessage') }}}</div>
        @endif

        @yield('content')

        @yield('bottomscript')
<script>
    //script to make error or success message disappear after a couple seconds
    $('.fade_message').delay(2000).fadeOut(1000);
</script>
    </body>
</html>