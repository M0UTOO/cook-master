<?php

namespace App\Controllers;

use Exception as GlobalException;
use FFI\Exception;

class Home extends BaseController
{
    public function index()
    {
        $data['orders'] = callAPI('/order/random', 'get');
        $data['title'] = "Cookmaster - Home page";
        return view('home', $data);
    }


}
