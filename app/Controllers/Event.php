<?php

namespace App\Controllers;

class Event extends BaseController
{
    public function index(){

        $data['title'] = "Cookmaster - Events";
        $data['events'] = callAPI('/event/all', 'get');
        return view('event/index', $data);
    }

}