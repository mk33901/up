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
        $this->appId = config('app.appId');
        $this->secret = config('app.secret');
        $this->endUrl = config('app.endUrl');
    }

    public function call()
    {
        return Http::withHeaders(['x-client-secret'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json','x-api-version'=>'2022-01-01']);
    }

    public function createOrder(array $data)
    {
        try {
            $data = $this->generateOrder($data);
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/pg/orders");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function payOrder(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/pg/orders/pay");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getSavedCard(array $data,$customer_id)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/pg/customers/$customer_id/instruments");
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $newData['customer_details']['customer_id'] = $user->uuid;
        $newData['customer_details']['customer_email'] = $user->email;
        $newData['customer_details']['customer_phone'] = "888888888";
        $newData['order_id'] = $order->uuid;
        $newData['order_amount'] = $order->price;
        $newData['order_currency'] = $order->currency;
        $newData['order_meta']['return_url'] = url('/');
        $newData['order_meta']['notify_url'] = url('/');
        $newData['order_expiry_time'] = Carbon::now()->addDays(1);
        return $newData;
    }
}
