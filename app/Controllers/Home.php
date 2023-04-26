<?php

namespace App\Controllers;

use Exception as GlobalException;
use FFI\Exception;

class Home extends BaseController
{
    public function index()
    {

        try{
            $rest_api_base_url = 'http://localhost:9000';
            $get_endpoint = '/foo';
            // Instance
            $curl = \Config\Services::curlrequest(['baseURI' => $rest_api_base_url]);
    
            $response = $curl->get($get_endpoint, ['verify' => false]); //disable SSL: verify => false
    
            $data['foo'] = $response->getBody();
        } catch (GlobalException $e) {
            $data['error'] = $e->getMessage();
        }   
      
        return view('welcome_message', $data);
    }
}
