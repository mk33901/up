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

    public function call()
    {
        return Http::withHeaders(['Authorization'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json']);
    }

    public function authorize()
    {
        try {
            return Http::withHeaders(['x-client-secret'=>$this->secret,'x-client-id'=>$this->appId,'content-type' => 'application/json'])->post("$this->endUrl/payout/v1/authorize");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getBeneficiary(string $beneficiaryId)
    {
        try {
            return $this->call()->post("$this->endUrl/payout/v1/getBeneficiary/$beneficiaryId");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function addBeneficiary(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/payout/v1/addBeneficiary");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeBeneficiary(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/payout/v1/removeBeneficiary");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function requestAsyncTransfer(array $data)
    {
        try {
            return $this->call()->withBody('application/json',json_encode($data))->post("$this->endUrl/payout/v1/requestAsyncTransfer");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getPaymentStatus(string $transactionId)
    {
        try {
            return $this->call()->post("$this->endUrlpayout/v1/getTransferStatus?referenceId=$transactionId");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
