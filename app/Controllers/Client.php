<?php

namespace App\Controllers;

class Client extends Users
{
    public function subscribe($id){
        $data['title'] = "Subscribe to a subscription";

        if (isLoggedIn() && isClient()){
            $data['message'] = callAPI('client/subscription/'.getCurrentUserId().'/'.$id, 'patch');
        }
        return redirect()->back()->with('message', $data['message']['message']);
    }

    public function paySubscription($id){
        redirect()->to('checkout?subscription='.$id);
    }

}
