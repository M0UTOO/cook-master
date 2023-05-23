<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function isManager(): bool{
        helper('session');
        return (session()->get('role') == 'manager');

    }

    protected function checkAccess(){
        // Check if the user is a manager (check role in session data)
        if ($this->isManager() != 'manager') {

            echo "Unauthorized\n";
            redirect('unauthorized');
        } else{
            return "true";
        }
    }

    public function index()
    {
        if ($this->checkAccess() == "true"){
            $data['title'] = "Dashboard";
            return view('dashboard/index');
        }
    }

    public function userManagement()
    {
        helper('curl_helper');

        if ($this->checkAccess() == "true"){
            $data['title'] = "Users Management";
           // $data['users'] = callAPI('/manager/all', 'get', []);
            $data['managers'] = callAPI('/manager/all', 'get', []);
            $data['contractors'] = callAPI('/contractor/all', 'get', []);
            $data['clients'] = callAPI('/client/all', 'get', []);
            //UNDER IS no cuz how do we keept track of the role of each
            // $data['users'] = array_merge($data['managers'], $data['contractors'], $data['clients']);
            return view('dashboard/user_management', $data);
        }
    }

    public function eventManagement()
    {
        if ($this->checkAccess() == "true"){
            //This will be the same page that users and contractors will see when going on the events page
            //BUT the manager can add , delete an event and mofify them too
            $data['managerView'] = true; //check thru this or thru the session(role) might be better too
            return view('events/index', $data);
        }
    }

    public function itemManagement(){

    }
    public function premisesManagement(){

    }
}