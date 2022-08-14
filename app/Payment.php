<?php

namespace App;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;

class Payment
{
    private string $appId;
    private string $secret;
    private string $endUrl;
    public function __construct() {
        $this->appId = config('app.auto-collect.appId');
        $this->secret = config('app.auto-collect.secret');
        $this->endUrl = config('app.auto-collect.endUrl');
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

    public function createSubscription($user)
    {
        try {
            
            $data=[
                "subscriptionId" =>"SUB".str_replace("-","_",$user->uuid),
                "planId"=>"0100",
                "customerEmail"=>$user->id,
                "customerPhone"=>"93465577484",
                "expiresOn" =>Carbon::now()->addYears(1),
                "returnUrl"=>url('/return')
            ];            
            $http = $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/api/v2/subscriptions");
            if($http->successful())
            {
                $data = $http->json();
                $subscribe = Subscription::create([
                    'subscription_id'=>"SUB".str_replace("-","_",$user->uuid),
                    'ref_id'=>$data['subReferenceId'],
                    'auth_link'=>$data['authLink'],
                    'user_id'=>$user->id,
                    'status'=>0,
                    'expires_on'=>Carbon::now()->addYears(1),
                    'response'=>$http->body()
                ]);
                return $subscribe;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
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
