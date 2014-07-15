<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tweets for Charity</title>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/bootstrap-3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="/bootstrap-3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="css" href="/bootstrap-3.2.0/css/demo.css"/>
    <link href="/bootstrap-3.2.0/css/carousel.css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
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
                <a class="navbar-brand" href="index.php"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('users_sign_up') ? 'active' : '' }}"><a href="/users_sign_up">Donor Sign Up</a>
                    </li>
                    <li class="{{ Request::is('charities_sign_up') ? 'active' : '' }}"><a href="/charities_sign_up">Charities Sign Up</a>
                    </li>
                    <li class="{{ Request::is('user_dashboard') ? 'active' : '' }}"><a href="/user_dashboard">Dashboard</a>
                    </li>    
                    <li class="{{ Request::is('')  ? 'active' : ''}}"><a href=""></a>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
</nav> 

    <body>
        @yield('topscript')

        @yield('content')

        @yield('bottomscript')

    </body>
</html>