<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Stripe;

class Payment extends BaseController
{
    public function index()
    {
        $data['title'] = "Cookmaster - Payment";
        return view('subscription/pay_subscription', $data);
    }

    public function createCharge()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_TOKEN'));

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 5,
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            echo json_encode($output);

        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
