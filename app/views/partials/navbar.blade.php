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
                                                
                                                @if (Auth::check())
                                                  @if(Auth::user()->role_id = User::ROLE_DONOR)
                                                    <li class="right">
                                                        <a href="{{ action('UsersController@edit', Auth::user()->twitter_handle) }}">Edit</a></li>
                                                    @elseif(Auth::user()->role = User::ROLE_CHARITY)

                                                      <a href="{{ action('CharitiesController@edit', Auth::user()->twitter_handle) }}">Edit</a></li>
                                                    @endif      
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