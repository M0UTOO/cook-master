<?php

namespace App\Controllers;

use Exception as GlobalException;
use FFI\Exception;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Cookmaster - Home page";
        $data['orders'] = callAPI('/order/random', 'get');
        return view('home', $data);
    }
}
