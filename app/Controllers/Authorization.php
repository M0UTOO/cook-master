<?php

namespace App\Controllers;

class Authorization extends BaseController
{
    public function unauthorized()
    {
        $data['title'] = "Unauthorized";
        return view('errors/html/error_401', $data);
    }
}