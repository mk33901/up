<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PaymentOrder
{
    private string $appId;
    private string $secret;
    private string $endUrl;
    public function __construct() {
        $this->appId = "177035df0c202b657b6d5f001c530771";
        $this->secret = "9ddf3b4151e4711778e7a9b0493e526b87cea5d3";
        $this->endUrl = "https://sandbox.cashfree.com";
    }

    public function call()
    {
        return Http::withHeaders(['x-client-secret'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json','x-api-version'=>'2022-01-01']);
    }

    public function createOrder(array $data)
    {
        try {
            $data = $this->generateOrder($data);
            return $this->call()->withBody(json_encode($data),'application/json')->post("$this->endUrl/pg/orders")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function autherizePayOrder(array $data)
    {
        try {
            $data = $this->generateOrder($data,"auth");
            return $this->call()->withBody(json_encode($data),'application/json')->post("$this->endUrl/pg/orders")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function payOrder(array $data)
    {
        try {
            $data = $this->generatePay($data);
            \Log::info($data);
            return $this->call()->withBody(json_encode($data),'application/json')->post("$this->endUrl/pg/orders/pay")->body();
        } catch (\Throwable $th) {
            \Log::info($th);
            return $th;
            //throw $th;
        }
    }

    public function getOrderStatus(array $data,$order_id)
    {
        try {
            return $this->call()->get("$this->endUrl/pg/orders/$order_id/payments")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getSavedCard(array $data,$customer_id)
    {
        try {
            return $this->call()->withBody(json_encode($data),'application/json')->get("$this->endUrl/pg/customers/$customer_id/instruments?instrument_type=card")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function generatePay($data, $type='normal')
    {
        $newData = [];
        if(isset($data['card']))
        {
            $card = $data['card'];
        }
        $newData['order_token'] = $data['order_token'];
        $newData['save_instrument'] = true;
        $card['channel'] = 'link';
        $card['card_cvv'] = '123';
        // $card =
        // [
        //     "channel"=> "link",
        //     "card_number"=> $card["card_number"],
        //     "card_holder_name"=> $card["card_holder_name"],
        //     "card_expiry_mm"=> $card["card_expiry_mm"],
        //     "card_expiry_yy"=> $card["card_expiry_yy"],
        //     "card_cvv"=> $card["card_cvv"],
        //     "card_display"=> $card["card_display"]
        // ];
        
        $newData["order_tags"]["type"]=$type;
        $newData["payment_method"]["card"]=$card;
        return $newData;

    }
    public function generateOrder($data)
    {
        $newData = [];
        if(isset($data['user']))
        {
            $user = $data['user'];
        }
        if(isset($data['order']))
        {
            $order = $data['order'];
        }
        $orderId = $order->uuid.Date('Hi');
        if(isset($data['type']))
        {
            $orderId = $data['type']."-".$orderId;
        }
        $newData['customer_details']['customer_id'] = $user->uuid;
        $newData['customer_details']['customer_email'] = $user->email;
        $newData['customer_details']['customer_phone'] = "+91888888888";
        $newData['order_id'] = $orderId;
        $newData['order_amount'] = (int)$order->price;
        $newData['order_currency'] = "INR";
        $newData['order_meta']['return_url'] = url('/api/store/card')."?order_id={order_id}&order_token={order_token}";
        $newData['order_meta']['notify_url'] = url('/api/store/card')."?order_id={order_id}&order_token={order_token}";
        $newData['order_expiry_time'] = Carbon::now()->addMinutes(20)->toIso8601String();
        return $newData;
    }
}
