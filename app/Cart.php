<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $totalPurePrice = 0;
    public $totalDisCountPrice = 0;
    public $CouponDisCountPrice = 0;
    public $coupon = null;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items =  $oldCart->items;
            $this->totalQty =  $oldCart->totalQty;
            $this->totalPrice =  $oldCart->totalPrice;
            $this->totalPurePrice =  $oldCart->totalPurePrice;
            $this->totalDisCountPrice =  $oldCart->totalDisCountPrice;
        }
    }

    public function add($item , $id)
    {
        if($item->discount_price){
            $storeItem =['qty'=> 0 , 'price' => $item->discount_price ,'item'=>$item];
        }else{
            $storeItem =['qty'=> 0 , 'price' => $item->price ,'item'=>$item];
        }
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storeItem=$this->items[$id];
            }
        }

        $storeItem['qty']= $storeItem['qty'] +1;
        if($item->discount_price){
            $storeItem['price']=$item->discount_price * $storeItem['qty'];
            $this->totalPrice += $item->discount_price;
            $this->totalDisCountPrice += ($item->price - $item->discount_price);
        }else{
            $storeItem['price']=$item->price * $storeItem['qty'];
            $this->totalPrice += $item->price;

        }
        $this->items[$id] =  $storeItem;
        $this->totalQty ++;
        $this->totalPurePrice +=$item->price;

    }

    public function remove($item , $id)
    {
        if($this->items){
            if(array_key_exists($id,$this->items)){
                if($item->discount_price){
                    $this->items[$id]['price'] -=$item->discount_price;
                    $this->totalPrice -= $item->discount_price;
                    $this->totalDisCountPrice -= ($item->price - $item->discount_price);
                }else{
                    $this->items[$id]['price'] -=$item->price;
                    $this->totalPrice -= $item->price;

                }
                $this->totalQty --;
                $this->totalPurePrice -=$item->price;

                if($this->items[$id]['qty'] >1){
                    $this->items[$id]['qty']--;
                }else{
                    unset($this->items[$id]);
                }
            }
        }

    }

    public function addCoupon($coupon)
    {
        $CouponDisCount =['price' => $coupon->price ,'coupon'=>$coupon];
        $this->coupon =$CouponDisCount;
        $this->totalPrice -=$CouponDisCount['price'];
        $this->CouponDisCountPrice +=$CouponDisCount['price'];

    }
}
