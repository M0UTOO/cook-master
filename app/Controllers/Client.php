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

    public function books(){
        $values = $this->request->getPost();
        $idCookingSpace = $values['idCookingSpace'];

        if (isLoggedIn() && isClient()){
            if ( getSubscription())
            //if can book a room
            {
                $values['starttime']= $values['date'].' '.$values['starttime'];
                $values['endtime']= $values['date'].' '.$values['endtime'];
                unset($values['date']);
                $values['iduser'] = (int) getCurrentUserId();
                $values['idCookingSpace'] = (int) $idCookingSpace;

                //try to pay. If it works, book the room.

               $data['message'] = callAPI('/cookingspace/books/'.$values['iduser'].'/'.$idCookingSpace, 'patch', $values);
               return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', $data['message']['message']);
            }

        } else{
            return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', $data['message']['message']);
        }
    }

    public function paySubscription($id){
        redirect()->to('checkout?subscription='.$id);
    }
}