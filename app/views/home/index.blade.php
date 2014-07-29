@extends('layouts.master')

@section('content')
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    
    <section id="intro" class="home-slide text-light">

        <!-- Carousel -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/salvation_army.jpg" alt="First slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Donate to charities using Twitter</span>
                            </h2>
                            <br>
                            <h3>
                                <span>Every tweet is a chance to change lives and help others.</span>
                            </h3>
                            <br>
                            <div class="">
                                 <a class="btn btn-theme btn-sm btn-min-block" href="#about">About us</a><a class="btn btn-theme btn-sm btn-min-block" href="#works">How it works</a><a class="btn btn-theme btn-sm btn-min-block" href="{{action('CharitiesController@index') }}">Our Charities</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="/aspca_twitter.jpg" alt="Second slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Choose local or global charities</span>
                            </h2>
                            <br>
                            <h3>
                                <span>You can help your local community or spread the wealth around the world.</span>
                            </h3>
                            <br>
                            <div class="">
                                 <a class="btn btn-theme btn-sm btn-min-block" href="#about">About us</a><a class="btn btn-theme btn-sm btn-min-block" href="#works">How it works</a><a class="btn btn-theme btn-sm btn-min-block" href="{{ action('CharitiesController@index') }}">Our Charities</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="/wwf.jpg" alt="Third slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>No additional charges</span>
                            </h2>
                            <br>
                            <h3>
                                <span>Our users will not be charged any additional fees for using our service to donate.</span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="#about">About us</a><a class="btn btn-theme btn-sm btn-min-block" href="#works">How it works</a><a class="btn btn-theme btn-sm btn-min-block" href="{{ action('CharitiesController@index') }}">Our Charities</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!-- /carousel -->

    </section>
    <!-- /Section: intro -->
  @stop
  
  @section('content2')
  <!-- Section: services -->
    <section id="works" class="home-section color-dark bg-gray">
    <div class="container marginbot-50">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
          <div class="section-heading text-center">
          <h2 class="h-bold">How it works</h2>
          <div class="divider-header"></div>
          <p>How your tweets let you donate to charity.</p>
          </div>
          </div>
        </div>
      </div>

    </div>

    <div class="text-center">
    <div class="container">

        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-3">
        <div class="wow fadeInLeft" data-wow-delay="0.2s">
                <div class="service-box">
          <div class="service-icon">
            <span class="font-color fa fa-pencil fa-5x"></span> 
          </div>
          <div class="service-desc">            
            <h5>Registration</h5>
            <p>
            Twitter users and charities can create an account on our website.  Twitter users will register with payment infomation and charities will register with official tax forms for verification.
            </p>
            <a href="#" class="btn btn-skin">Learn more</a>
          </div>
                </div>
        </div>
            </div>
      <div class="col-xs-6 col-sm-3 col-md-3">
        <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-box">
          <div class="service-icon">
            <span class="font-color fa fa-twitter fa-5x"></span> 
          </div>
          <div class="service-desc">
            <h5>Tweet!</h5>
            <p>
            Twitter user's tweet count is recorded each month and then, based on user-selected amounts, a donation is made to user-selected charities.  Twitter users will also be able to modify the distribution of the donations between charities.
            </p>
            <a href="#" class="btn btn-skin">Learn more</a>
          </div>
                </div>
        </div>
            </div>
      <div class="col-xs-6 col-sm-3 col-md-3">
        <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-box">
          <div class="service-icon">
            <span class="font-color fa fa-credit-card fa-5x"></span> 
          </div>
          <div class="service-desc">
            <h5>Payment</h5>
            <p>
            Twitter users will be charged monthly for the accrued amount to be donated to their selected charities.  User's accounts will reflect the total number of tweets, their donation amount preferences, and payment history.
            </p>
            <a href="#" class="btn btn-skin">Learn more</a>
          </div>
                </div>
        </div>
            </div>
      <div class="col-xs-6 col-sm-3 col-md-3">
        <div class="wow fadeInRight" data-wow-delay="0.2s">
                <div class="service-box">
          <div class="service-icon">
            <span class="font-color fa fa-globe fa-5x"></span> 
          </div>
          <div class="service-desc">
            <h5>Helping you help others</h5>
            <p>
            Tweets for Charity will take the total donated amounts for all of our registered users and cut a check to each of our registered charities.  
            </p>
            <a href="#" class="btn btn-skin">Learn more</a>
          </div>
                </div>
        </div>
            </div>
        </div>    
    </div>
    </div>
  </section>
  <!-- /Section: services -->
  

  <!-- Section: works -->
    <section id="about" class="home-section color-dark text-center bg-white">
    <div class="container marginbot-50">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
          <div class="section-heading text-center">
          <h2 class="font-color h-bold">About Us</h2>
          <div class="font-color divider-header"></div>
          <p>Who we are and what we do.</p>
          </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3 col-md-offset-1"><a href="#" title="Andre" data-lightbox-gallery="gallery1" data-lightbox-hidpi="Andre2.jpg"><p>Andre</p><img src="Andre2.jpg" class="img-responsive" alt="img"></a></div>

        <div class="col-md-3"><a href="#" title="Nicole" data-lightbox-gallery="gallery1" data-lightbox-hidpi="Nicole2.jpg"><p>Nicole</p><img src="Nicole2.jpg" class="img-responsive" alt="img"></a></div>

        <div class="col-md-3"><a href="#" title="Andrew" data-lightbox-gallery="gallery1" data-lightbox-hidpi="Andrew1.jpg"><p>Andrew</p><img src="Andrew1.jpg" class="img-responsive" alt="img"></a></div>
      </div>
    </div>

  </section>
  <!-- /Section: works -->

  <!-- Section: contact -->
    <section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">
    <div class="container marginbot-50">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
          <div class="section-heading text-center">
          <h2 class="h-bold">Contact us</h2>
          <div class="divider-header"></div>
          <p>We want to know what you think.  Drop us a line.</p>
          </div>
          </div>
        </div>
      </div>

    </div>
    
    <div class="container">

      <div class="row marginbot-80">
        <div class="col-md-8 col-md-offset-2">
            <form id="contact-form" class="wow bounceInUp" data-wow-offset="10" data-wow-delay="0.2s">
            <div class="row marginbot-20">
              <div class="col-md-6 xs-marginbot-20">
                <input type="text" class="form-control input-lg" id="name" placeholder="Enter name" required="required" />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control input-lg" id="email" placeholder="Enter email" required="required" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" id="subject" placeholder="Subject" required="required" />
                </div>
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="4" cols="25" required="required"
                    placeholder="Message"></textarea>
                </div>            
                <button type="submit" class="btn btn-skin btn-lg btn-block" id="btnContactUs">
                  Send Message</button>
              </div>
            </div>
            </form>
        </div>
      </div>  
    </div>
  </section>
  <!-- /Section: contact -->
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="text-center">
                <a href="#" class="totop"><i class="fa fa-angle-up fa-3x"></i></a>
                <p>Tweets for Charity,  a Codeup project.  tweetsforcharity@gmail.com<br>
                &copy;Tweets for Charity. <a href="http://www.tweets-for-charity.com">Tweets for Charity</a></p>
              </div>
            </div>
          </div>  
        </div>
      </footer>

@stop