<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// // Visit http://site.com/twitter-redirect
// Route::get('ct-twitter-redirect', function(){
//     // Reqest tokens
//     $tokens = Twitter::oAuthRequestToken();

//     // Redirect to twitter
//     Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
//     exit;
// });

// // Redirect back from Twitter to http://site.com/twitter-auth
// Route::get('callback', function(){

//     // Oauth token
//     $token = Input::get('oauth_token');

//     // Verifier token
//     $verifier = Input::get('oauth_verifier');

//     // Request access token
//     $accessToken = Twitter::oAuthAccessToken($token, $verifier);

//     $twitterId = $accessToken['user_id'];
//     $twitterUsername = $accessToken['screen_name'];
//     $twitterToken = $accessToken['oauth_token'];
//     $twitterTokenSecret = $accessToken['oauth_token_secret'];

//     // is this an existing user?
//     $user = User::findByTwitterId($twitterId);

//     if ($user)
//     {
//         // existing user
//         $user->twitter_handle = $twitterUsername;
//         $user->oauth_token = $twitterToken;
//         $user->oauth_token_secret = $twitterTokenSecret;
//         $user->save();
//     }
//     else
//     {
//         // this is a new user, create them in the db
//         $user = new User();
//         $user->role_id = User::ROLE_UNINITIALIZED;
//         $user->user_id = $twitterId;
//         $user->twitter_handle = $twitterUsername;
//         $user->oauth_token = $twitterToken;
//         $user->oauth_token_secret = $twitterTokenSecret;
//         $user->save();
//     }

//     Auth::loginUsingId($user->id);

//     return Redirect::to('/'); // todo go to user dashboard based on role
// });


// Route::get('more-info-required', function(){
//     return 'Collect additional user info and save it';
// });

// Route::post('more-info-required', function(){
//     // save new user role and info
//     // redirect to dashboard
// });

// ____________________________________________________________________________________________
Route::get('/', 'HomeController@showHome');
Route::get('/demo', function () {
    return View::make('tweetsforcharity.demo');
});

// Route::get('/users_sign_up', 'UsersController@twitter_redirect');

Route::get('/twitter-redirect', function(){
    // Reqest tokens
    $tokens = PhiloTwitter::oAuthRequestToken();
    // Redirect to twitter
    PhiloTwitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
    exit;
});

Route::get('/twitter_redirect', 'HomeController@twitter_redirect');
Route::get('/callback', 'UsersController@create');

//Route::get('/callback', 'UsersController@create'); 
route::put('/registration/{twitter_handle}', 'HomeController@registration');

Route::resource('users', 'UsersController');
Route::resource('charities', 'CharitiesController');

// Route::resource('/charities_sign_up', 'CharitiesController@create');

Route::resource('donors', 'DonorsController');
//Route::resource('/charities_sign_up', 'CharitiesController@create');
Route::get('/public_profile', 'UsersController@showProfile');


Route::get('/users_sign_up', 'UsersController@create');

//these belong to the resource controllers and should not be in the route because the resource route already calls them


 // Route::get('/users_sign_up', 'UsersController@create');
 Route::get('/charities_sign_up', 'CharitiesController@create');

Route::get('/login', 'HomeController@showLogin');
Route::post('/login', 'HomeController@doLogin');
Route::get('/logout', 'HomeController@logout');
route::get('/thankyou', function() {
    return View::make('tweetsforcharity.users_exit_page');
});

/*
|
| Replace these controllers with Ajax controllers in the future to avoid page redirects and refreshes on the 
| user dashboard
|
*/
Route::get('/drop_charity', 'HomeController@removeCharity');
Route::get('/add_charity', 'HomeController@addCharity');


Route::get('test', function () {

    $maxHeight = 200;
    $maxWidth = 200;

    $newHeight = 0;
    $newWidth = 0;


    $inputFile = public_path() . '/uploads/ct.jpg';
    $outputFile = public_path() . '/uploads/ct-small.jpg';

    // load the image to be manipulated
    $image = new Imagick($inputFile);

    // get the current image dimensions
    $currentWidth = $image->getImageWidth(); 
    $currentHeight = $image->getImageHeight();

    // determine what the new height and width should be based on the type of photo
    if ($currentWidth > $currentHeight)
    {
        // landscape photo
        // width should be resized to max and height should be resized proportionally
        $newWidth = $maxWidth;
        $newHeight = ceil($currentHeight * ($newWidth / $currentWidth));
    }
    else if ($currentHeight > $currentWidth)
    {
        // portrait photo
        // height should be resized to max and width should be resized proportionally
        $newHeight = $maxHeight;
        $newWidth = ceil($currentWidth * ($newHeight / $currentHeight));
    }
    else
    {
        // square photo
        // resize image to max dimensions
        $newHeight = $newWidth = $maxHeight;
    }

    // perform the image resize
    $image->resizeImage($newWidth, $newHeight, Imagick::FILTER_LANCZOS, true);  

    // write out the new image
    $image->writeImage($outputFile);

    // clear memory resources
    $image->clear(); 
    $image->destroy();

    return 'Done';

});

Route::post('updateCharity', function () {
    dd(formValues);
    $twitter_handle = Input::get('twitter_handle');
    $user = User::findByTwitterHandle($twitter_handle);
    $id = Input::get('charity_id');
    $name = Input::get('alloted_percent');

    $error = false;
    $message = "Successfully processed id: $id with name: $name.";

    $result = array(
        'error' => $error,
        'message' => $message,
    );

    return Response::json($result);

});

?>