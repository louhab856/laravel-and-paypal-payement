<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
class PaypalController extends Controller
{
    public function goPayement(){
        return view("products.welcome");
    }
    public function payment(){
        $data = [];
        $data["items"]=[
            [
                'name'=>"Appel",
                'price'=>100,
                "description"=> "Mack boock Pro 14 inch",
                "qty"=> 1
            ] ,
            
        ];
        $data["invoice_id"]= 1 ;
        $data["invoice_description"]= "order";
        $data["return_url"]= route('payment.success'); 
        $data["cancel_url"]= route('payment.cancel');  
        $data["total"]= 100 ;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data , true);
        return redirect($response['paypal_link']);
    }
    public function cancel()
    {
        dd('Your payment is canceled.');
    }
    public function success(Request $request){
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS' , 'SUCCESSWITHWARNING'])) {
            dd('your payement was done , successflly , thanks !'  );
        }
        dd('please try again later ') ;
    }
}
