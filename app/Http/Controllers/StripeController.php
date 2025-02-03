<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');  
    }

    public function checkout()
    {
        Stripe::setAptKey(config(stripe.sk));

        $session = \Stripe\checkout\Session::create([
            'line_items' => [
                [

                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!!',
                        ],
                        'unit_amount' => 500,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode'=> 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('index'),

        ]);

        return redirect()->away($session->url);
    }

    public function sucess()
    {
        return view('success');
    }


}
