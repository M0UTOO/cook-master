<?php

namespace App\Controllers;

use Exception as GlobalException;
use FFI\Exception;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Cookmaster - Home page";

        return view('home', $data);
    }


    private function randomOrders(){
        $data['orders'] = callAPI('/order/random', 'get');
    }
}
