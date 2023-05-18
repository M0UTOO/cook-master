<?php

namespace App\Controllers;

class Authorization extends BaseController
{

    public function unauthorized(): string
    {
        $data['title'] = "Unauthorized";
        return view('errors/html/unauthorized', $data);
    }
}