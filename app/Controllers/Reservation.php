<?php

namespace App\Controllers;

class Reservation extends BaseController
{
    //Everyone can
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL SUBSCRIPTIONS
        $data['title'] = "Cookmaster - Subscription";
        $data['subscriptions'] = callAPI('/subscription/all', 'get');
        return view('subscription/index', $data);
    }

    public function showReservationsByRoom($room_id){

    }


}