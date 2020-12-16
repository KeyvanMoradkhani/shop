<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function PaymentVerify(Request $request,$order_id)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $payment = new Payment($cart->totalPrice,$order_id);
        $result = $payment->checkPayment($request->Authority, $request->Status);

        if ($result) {

            $order = Order::findOrFail($order_id);
            $order->status = 1;
            $order->save();

            $payment->authority =  $request->Authority;
            $payment->status =  $request->Status;
            $payment->RefID =  $result->RefID;
            $payment->order_id =  $order_id;
            $payment->save();

            Session::forget('cart');

            Session::flash('success-payment' , 'پرداخت با موفقیت انجام شد.');
            return redirect()->to('/profile');

        } else {
            Session::flash('danger-payment' , 'پرداخت با موفقیت انجام نشد.');
            return redirect()->to('/cart');
        }
    }
}
