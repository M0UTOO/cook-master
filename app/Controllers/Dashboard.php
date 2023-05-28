<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected function checkAccess(): bool
    {
        // Check if the user is a manager (check role in session data)
        if (!isManager()) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        if ($this->checkAccess()){
            $data['title'] = "Dashboard";
            return view('dashboard/index', $data);
        } else {
            return redirect()->to('/')->with('message', 'You are not authorized to access this page');
        }
    }

    public function userManagement()
    {
        helper('curl_helper');

        if ($this->checkAccess() == "true"){
            $data['title'] = "Users Management";
            $data['isManager'] = isManager();

            $data['users']['managers'] = callAPI('/manager/all', 'get');
            $data['users']['contractors'] = callAPI('/contractor/all', 'get');
            $data['users']['clients'] = callAPI('/client/all', 'get');

            return view('dashboard/user_management', $data);
        }
    }
    public function subscriptionManagement()
    {
        helper('curl_helper');

        if ($this->checkAccess() == "true"){
            $data['title'] = "Subscription Management";
            //$data['isManager'] = isManager();

            $data['subscriptions'] = callAPI('/subscription/all', 'get');

            return view('dashboard/subscription_management', $data);
        }
    }

    public function eventManagement()
    {
        if ($this->checkAccess() == "true"){
            //This will be the same page that users and contractors will see when going on the events page
            //BUT the manager can add , delete an event and mofify them too
            $data['managerView'] = true; //check thru this or thru the session(role) might be better too
            $data['isLoggedIn'] = isLoggedIn();
            $data['isManager'] = isManager();
            return view('events/index', $data);
        }
    }

    public function itemManagement(){

    }
    public function premisesManagement(){

    }
}