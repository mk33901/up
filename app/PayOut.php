<?php

namespace App;

use Illuminate\Support\Facades\Http;

class PayOut
{
    private string $appId;
    private string $secret;
    private string $endUrl;
    public function __construct() {
        $this->appId = config('app.appId');
        $this->secret = config('app.secret');
        $this->endUrl = config('app.endUrl');
    }

    public function call(string $token)
    {
        return Http::withToken($token);
    }

    public function authorize()
    {
        try {
            $http = Http::withHeaders(['x-client-secret'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json'])->post("$this->endUrl/payout/v1/authorize");
            if($http->successful())
            {
                $body = $http->json('data');
                return $body['token'];
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getBeneficiary(string $beneficiaryId)
    {
        try {
            $token = $this->authorize();
            if(!$token)
            {
                return false;
            }
            return $this->call($token)->get("$this->endUrl/payout/v1/getBeneficiary/$beneficiaryId")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function addBeneficiary(array $data)
    {
        try {
            $token = $this->authorize();
            if(!$token)
            {
                return false;
            }
            return $this->call($token)->withBody(json_encode($data),'application/json')->post("$this->endUrl/payout/v1/addBeneficiary")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeBeneficiary(array $data)
    {
        try {
            $token = $this->authorize();
            if(!$token)
            {
                return false;
            }
            return $this->call($token)->withBody(json_encode($data),'application/json')->post("$this->endUrl/payout/v1/removeBeneficiary")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function requestAsyncTransfer(array $data)
    {
        try {
            $token = $this->authorize();
            if(!$token)
            {
                return false;
            }
            return $this->call($token)->withBody(json_encode($data),'application/json')->post("$this->endUrl/payout/v1/requestAsyncTransfer")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getPaymentStatus(string $transactionId)
    {
        try {
            $token = $this->authorize();
            if(!$token)
            {
                return false;
            }
            return $this->call($token)->post("$this->endUrlpayout/v1/getTransferStatus?referenceId=$transactionId")->body();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
