<?php

namespace App\Controllers;

class Client extends Users
{
    public function subscribe(){
        $data['title'] = "Subscribe to a subscription";
        $subscription = $this->request->getGet('subscription');

        if (isLoggedIn() && isClient()){
            $data['message'] = callAPI('/client/subscription/'.getCurrentUserId().'/'.$subscription, 'patch');
            if (isset($data['message']['error']) && $data['message']['error']){
                return redirect()->to('/')->with('message', $data['message']['message']);
            } else {
            $newSubscription = callAPI('/subscription/'.$subscription, 'get');
            session()->set("subscription", $newSubscription);
            }
        }
        return redirect()->to('user/profile')->with('message', $data['message']['message']);
    }

    public function paySubscription($id){
        redirect()->to('checkout?subscription='.$id);
    }

}
