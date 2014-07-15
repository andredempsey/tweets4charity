<?php

class UsersController extends BaseController {

    public function showRegistration()
        {
            return View::make('tweetsforchairty.users_sign_up');
        }

    public function showUserDashboard()
        {
            return View::make('tweetsforcharity.user_dashboard');
        }   

    public function showPublicProfile()
        {
            return View::make('tweetsforchairty.public_profile');
        }     
}    