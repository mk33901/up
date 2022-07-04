<?php

namespace App;

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
}
