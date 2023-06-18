<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Stripe;

class Payment extends BaseController
{
    public function checkout()
    {
        if (session()->getFlashdata('subscriptionId')) {
            $subscriptionId = session()->getFlashdata('subscriptionId');
        }

        $data['title'] = "Cookmaster - Payment";
        $stripe = new \Stripe\StripeClient('sk_test_51NDazQA36Phbw0Qb2RScUzvSM4zL7Jl3M55NELKH8U415lAtDZDIwh6qssyxdoMDSbE42CTIW1I1P9pTxkYfyVnu00CqRNNXup');

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 50, //TODO:get this dynmically.
                'currency' => 'eur',
                'payment_method_types' => ['card']
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            $data['clientSecret'] = $output['clientSecret'];

        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

        return view('subscription/pay_subscription', $data);
    }

    public function createCharge()
    {

    }
}
