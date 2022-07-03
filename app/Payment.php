<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Payment
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
        return Http::withHeaders(['x-client-secret'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json']);
    }

    public function createPlan(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/api/v2/subscription-plans");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createSeamLessSubscription(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/api/v2/subscriptions");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getSubscription(string $subscriptionId)
    {
        try {
            return $this->call()->post("$this->endUrl/api/v2/subscriptions/$subscriptionId");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function cancelSubscription(string $subscriptionId)
    {
        try {
            return $this->call()->post("$this->endUrl/api/v2/subscriptions/$subscriptionId/cancel");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function subscriptionCharge(array $data)
    {
        try {
            $subscriptionId = $data['subscriptionId'];
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/api/v2/subscriptions/$subscriptionId/charge");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
