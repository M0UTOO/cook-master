<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Stripe;

class Payment extends BaseController
{
    public function checkout()
    {
        $data['title'] = "Cookmaster - Payment";
        $stripe = new \Stripe\StripeClient('pk_live_51NDazQA36Phbw0QbjUyboeaI3coCCHtWOiq1Z2elLv6vHjV59lUV5pVvqgcgQSIEnArbgROFpmOdKrpJ3BnFjX0u00m1jrxFST');

        $subscription = $this->request->getGet('subscription');
        if (!$subscription == null) {
            $data['subscription'] = callAPI('/subscription/' . $subscription, 'get');
            $price = $data['subscription']['price'];
            if ($price == 0) {
                return redirect()->to('/client/subscribe?subscription=' . $data['subscription']['idsubscription']);
            }
        } else {
            return redirect()->to('/subscriptions')->with('message', 'No subscription selected');
        }


        try {
            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => (int)$price * 100, //amount must be an integer in the smallest unit of the currency
                'currency' => 'eur',
                'payment_method_types' => ['card']
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            $data['clientSecret'] = $output['clientSecret'];

            session()->set("client_secret", $output['clientSecret']);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

        return view('subscription/pay_subscription', $data);
    }

    public function checkoutv2($price)
    {
        $price = (float) $price;
        $data['title'] = "Cookmaster - Reservation payment";
        $stripe = new \Stripe\StripeClient('pk_live_51NDazQA36Phbw0QbjUyboeaI3coCCHtWOiq1Z2elLv6vHjV59lUV5pVvqgcgQSIEnArbgROFpmOdKrpJ3BnFjX0u00m1jrxFST');

        try {
            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => (int)$price * 100, //amount must be an integer in the smallest unit of the currency
                'currency' => 'eur',
                'payment_method_types' => ['card']
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            $data['clientSecret'] = $output['clientSecret'];

            session()->set("client_secret", $output['clientSecret']);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

        $data['reservation'] = $price;
        return view('cookingSpace/pay_reservation', $data);
    }
}
