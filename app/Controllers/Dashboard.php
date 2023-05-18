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

            echo "ok2\n";
            return redirect('unauthorized');
        } else{
            return "true";
        }
    }

    public function index()
    {
        if ($this->checkAccess() == "true"){
            return view('dashboard/index');
        }
    }

    public function userManagement()
    {
        helper('curl_helper');

        if ($this->checkAccess() == "true"){
            $data['title'] = "Users Management";
            $data['users'] = callAPI('/contractor/all', 'get', []);
//            $data['managers'] = callAPI('/manager/all', 'get', []);
//            $data['contractors'] = callAPI('/contractor/all', 'get', []);
//            $data['clients'] = callAPI('/client/all', 'get', []);
            //UNDER IS no cuz how do we keept track of the role of each
            // $data['users'] = array_merge($data['managers'], $data['contractors'], $data['clients']);
            return view('dashboard/user_management', $data);
        }
    }

    public function eventManagement()
    {
        if ($this->checkAccess() == "true"){
            $data['title'] = "Events Management";
            return view('dashboard/event_management', $data);
        }
    }
}