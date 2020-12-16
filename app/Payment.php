<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoapClient;

class Payment extends Model
{
    private $MerchantID;
    private $Amount;
    private $Description;
    private $CallbackURL;

    public function __construct($amount,$order_id)
    {
        $this->MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
        $this->Amount = $amount;
        $this->Description = 'توضیحات تراکنش تستی';
        $this->CallbackURL = 'http://shop.test/payment-verify/'.$order_id .'/';
    }

    public function doPayment()
    {
        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $this->Amount,
                'Description' => $this->Description,
                'CallbackURL' => $this->CallbackURL,
            ]
        );
        return $result;
    }

    public function checkPayment($authority,$status)
    {
        if ($status== 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $authority,
                    'Amount' => $this->Amount,
                ]
            );
            return $result;
        }

    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
