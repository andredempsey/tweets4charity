<?php
class CharitiesController extends BaseController {

    public function showRegistration()
        {
            return View::make('tweetsforcharity.charities_sign_up');
        }

    public function showCharityDashboard()
        {
            return View::make('tweetsforcharity.charity_dashboard');
        }    
}    