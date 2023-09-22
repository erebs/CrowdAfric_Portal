<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Flutterwave\EventHandlers\EventHandlerInterface;
use Flutterwave\Flutterwave;


class PaymentController extends Controller
{

   private $flutterwave;

   

    public function pay()
    {
        return view('payment.pay');
    }

    public function processPayment()
    {
        return view('payment.processPayment');
    }
       
}

