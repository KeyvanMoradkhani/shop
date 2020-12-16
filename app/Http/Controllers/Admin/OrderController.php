<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders =Order::get();
        return view('administrator.orders.index' , compact(['orders']));
    }

    public function getListOrder($id)
    {
        $order =Order::with(['products.photos','user.addresses.province','user.addresses.city'])->whereId($id)->first();
//        dd($order);
        return view('administrator.orders.list' , compact(['order']));
    }

    public function AllOrderList()
    {
        $orders =Order::all();

        $response = [
            'order' =>  $orders
        ];
        return response()->json($response,200);
    }
}
