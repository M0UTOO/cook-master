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
            $data['title'] = "Manager Dashboard";
            return view('dashboard/index', $data);
        } else {
            return redirect()->to('/')->with('message', 'You are not authorized to access this page');
        }
    }

    public function userManagement()
    {
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
        if ($this->checkAccess() == "true"){
            return redirect()->to('/subscriptions')->with('message', 'As a manager, you can view, add, delete and modify subscriptions');
        }
    }

    public function eventManagement()
    {
        if ($this->checkAccess() == "true"){
            return redirect()->to('/events')->with('message', 'As a manager, you can view, add, delete and modify events');
        }
    }

    public function itemManagement(){

    }
    public function premiseManagement(){
        if ($this->checkAccess() == "true"){
            return redirect()->to('/premises')->with('message', 'As a manager, you can view, add, delete and modify premises. You can also add cooking spaces.');
        }
    }
}