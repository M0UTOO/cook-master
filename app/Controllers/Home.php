<?php

namespace App\Controllers;

use Exception as GlobalException;
use FFI\Exception;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Cookmaster - Home page";
        $data['isLoggedIn'] = isLoggedIn();
        $data['isManager'] = isManager();
        if (isLoggedIn()){
            //$data["message"] = "You are logged in"; //make it a session flash message
        }
        return view('home', $data);
    }


}
