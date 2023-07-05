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
//            if (getSubscription()["allowroombooking"])
            var_dump(getSubscription());
            {
                $values['starttime']= $values['date'].' '.$values['starttime'];
                $values['endtime']= $values['date'].' '.$values['endtime'];
                unset($values['date']);
                //GET HOURS OF RSERVATIONS
                $reservationDuration = strtotime($values['endtime']) - strtotime($values['starttime']);
                $reservationDuration = $reservationDuration / 3600;

                //GET FULL PRICE
                $reservationPricePerHour = $values['pricePerHour'];
                $reservationPrice = $reservationDuration * $reservationPricePerHour;

                //FORMAT REQUEST DATA FOR API
                unset($values['pricePerHour']);
                $values['iduser'] = (int) getCurrentUserId();
                $values['idCookingSpace'] = (int) $idCookingSpace;

//                //try to pay. If it works, book the room.
//                $this->makePayement($reservationPrice);

               $data['message'] = callAPI('/cookingspace/books/'.$values['iduser'].'/'.$idCookingSpace, 'patch', $values);
               return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', $data['message']['message']);
//               return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message',"TEST OKAY - BOOKED");
            }

        } else{
            return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', $data['message']['message']);
        }
    }

    public function paySubscription($id){
        redirect()->to('checkout?subscription='.$id);
    }
}
