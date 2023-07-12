<?php

namespace App\Controllers;

class Client extends Users
{
    public function subscribe(){
        $data['title'] = "Subscribe to a subscription";
        $subscription = $this->request->getGet('subscription');
        $payement = $this->request->getGet('payment_intent_client_secret');

        if ($payement == session()->get('client_secret') || (int) $subscription == 1){
            if (isLoggedIn() && isClient()){
                $data['message'] = callAPI('/client/subscription/'.getCurrentUserId().'/'.$subscription, 'patch');
                if (isset($data['message']['error']) && $data['message']['error']){
                    return redirect()->to('/')->with('message', $data['message']['message']);
                } else {
                    $newSubscription = callAPI('/subscription/'.$subscription, 'get');
                    session()->set("subscription", $newSubscription);
                    return redirect()->to('user/profile')->with('message', $data['message']['message']);

                }
            }
        } else {
            return redirect()->to('/subscriptions')->with('message', 'Pay or we will call the cops.');
        }
    }

    public function books(){
        $values = $this->request->getPost();
        $idCookingSpace = $values['idCookingSpace'];

        if (isLoggedIn() && isClient() && getSubscription()["allowroombooking"]){
                $values['starttime']= $values['date'].' '.$values['starttime'];
                $tmp_time = strtotime($values['starttime']);
                $values['starttime'] = $tmp_time + 1;
                $values['starttime'] = date('Y-m-d H:i:s', $values['starttime']);

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

               $data['message'] = callAPI('/cookingspace/books/'.$values['iduser'].'/'.$idCookingSpace, 'patch', $values);

               if ($data['message']['error']){
                   return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', $data['message']['message']);
               } else {
                   session()->set('idcookingspace', $values['idCookingSpace']);
               return redirect()->to('checkoutv2/'.round($reservationPrice, 2))->with( 'message',lang('Common.bookResume', [$reservationDuration, $reservationPrice]));
               }

        } else{
            return redirect()->to('cookingSpace/'. $idCookingSpace)->with('message', "You can't book a cooking space");
        }
    }

    public function hasPayedReservation(){
        $payement = $this->request->getGet('payment_intent_client_secret');
        $status = $this->request->getGet('redirect_status');
        $idCookingSpace = session()->get('idcookingspace');

        var_dump($payement);
        var_dump($status);
        var_dump($idCookingSpace);
        var_dump(session()->get('client_secret'));

        if ($payement == session()->get('client_secret')) {
            if($status == "succeeded"){
                return redirect()->to('/user/profile/pastReservations/')->with('message', 'Your reservation has been successfully payed');
            } else {
                $data['message'] = callAPI('/books/'.getCurrentUserId().'/'.$idCookingSpace, 'delete');
                if (!$data['message']['error']){
                    return redirect()->to('/user/profile/pastReservations/')->with('message', 'An error has occured with your payment, please retry.');
                }
            }
        }else{
            return redirect()->to('/user/profile/pastReservations/')->with('message', 'An error has occured with your payment, please retry.');
        }
    }
}
