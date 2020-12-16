<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function OrderVerify()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if($cart && $cart->totalQty){

            $order =  new Order();
            $order-> amount =  $cart->totalPrice;
            $order-> user_id =  Auth::user()->id;
            $order-> status =  0;
            $order->save();

            $productId=[];
            foreach ($cart->items as $product){
                $productId[$product['item']->id]=['qty'=>$product['qty']];
            }
            $order->products()->sync($productId);

            $payment = new Payment($cart->totalPrice,$order->id);
            $result =$payment->doPayment();

            if ($result->Status == 100) {
                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
            } else {
                echo'ERR: '.$result->Status;
            }

        }else{
            Session::flash('warning-order' , 'سبد خرید شما خالی میباشد.');
            return redirect('/cart');
        }

    }
}
