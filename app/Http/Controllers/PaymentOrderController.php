<?php

namespace App\Http\Controllers;

use App\PayOut;
use App\Payment;
use Carbon\Carbon;
use App\PaymentOrder;
use App\Models\Contracts;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Models\PayoutTransaction;
use App\PaymentOrder as PaymentOrderClass;

class PaymentOrderController extends Controller
{
    public PaymentOrderClass $paymentorder;
    public Payment $payment;
    public PayOut $payout;
    public function __construct(PaymentOrderClass $paymentorder,PayOut $payout, Payment $payment)
    {
        $this->paymentorder = $paymentorder;
        $this->payout = $payout;
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = auth()->user();
            $cards = $this->paymentorder->getSavedCard([], $users->uuid);
            $data['data'] = $cards;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $data = [];
            $data['user'] = $user;
            $user->price = "1";
            $data['order'] = $user;
            $data['type'] = "card";
            $order = $this->paymentorder->createOrder($data);
            $responseData = json_decode($order, true);
            $transactions = Transactions::create([
                'user_id' => auth()->user()->id,
                'status' => 'pending',
                'transaction_date' => Carbon::now()->format("Y-m-d"),
                'payment_type' => 'user-' . $user->uuid,
                'response' => json_encode($responseData),
                'order_token' => $responseData['order_token'],
                'amount' => $responseData['order_amount'],
                'order_id' => $responseData['order_id'],
            ]);

            $data['data'] = $transactions;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
            return  $this->apiResponse($data, 404);
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authorizePayment(Request $request)
    {
        try{
            $data = $request->except('_token');
            $user = auth()->user();
            $data['user_id'] = $user->id;
            $user->price = '1';
            $orderData = [];
            $orderData['user'] = $user;
            $orderData['order'] = $user;
            $orderData['type'] = "auth";
            $order = New PaymentOrder();
            $response = $order->autherizePayOrder($orderData);
            $responseData = json_decode($response,true);
            if(!isset($responseData['order_id']))
            {
                $data['message'] = "Auth Fail";
                return  $this->apiResponse($data,404);
            }
            $transactions = Transactions::create([
                'user_id' => $user->id,
                'status' =>'pending',
                'response' =>$response,
                'order_id' =>$responseData['order_id'],
                'order_token' =>$responseData['order_token'],
                'amount' =>$responseData['order_amount'],
                'type' =>'auth',
                'transaction_date' => Carbon::now()->format("Y-m-d"),
                'payment_type'=> 'contract-'.$user->uuid
            ]);
            //$this->images($request,$contracts);
            $data['transactions'] = $transactions->id;
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentOrder $paymentOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentOrder $paymentOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentOrder $paymentOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentOrder $paymentOrder)
    {
        //
    }

    public function pay(Request $request)
    {
        try {
            $user = auth()->user();
            $transactions = Transactions::where('id', $request->id)->first();
            if (!$transactions) {
                $data['message'] = "order not found";
                return  $this->apiResponse($data, 404);
            }
            $postData = $request->all();
            $data = [];
            $card =
                [
                    "card_number" => $postData["card_number"],
                    "card_holder_name" => $postData["card_holder_name"],
                    "card_expiry_mm" => $postData["card_expiry_mm"],
                    "card_expiry_yy" => $postData["card_expiry_yy"],
                    "card_cvv" => $postData["card_cvv"],
                    "card_display" => $postData["card_display"]
                ];
            $data['order_token'] = $transactions->order_token;
            $data['card'] = $card;
            $order = $this->paymentorder->payOrder($data);
            $data['data'] = $order;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    public function getbeneficiary(Request $request)
    {
        try {
            $user = auth()->user();
            $benId = "BEN".str_replace("-","_",$user->uuid);
            $Beneficiary = Beneficiary::where('ben_id',$benId)->first();
            if(!$Beneficiary){
                $order = $this->payout->getBeneficiary($benId);
                $Beneficiary = json_decode($order,true);
            }
            $data['data'] = $Beneficiary;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }
    public function beneficiary(Request $request)
    {
        try {
            $user = auth()->user();
            $benId = "BEN".str_replace("-","_",$user->uuid);
            $data = [];
            $data['beneId'] = $benId;;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->name;
            if($request->type == 'bank')
            {
                $data['bankAccount'] = $request->bank_account;
                $data['ifsc'] = $request->ifsc;
                $data['address1'] = $request->address;
            }else if($request->type == 'card')
            {
                $data['cardNo'] = $request->card_no;
            }
            $order = $this->payout->addBeneficiary($data);
            
            $order = json_decode($order,true);
            $Beneficiary = Beneficiary::create([
                'ben_id' => $benId,
                'bank_account' => $request->bank_account,
                'ifsc' => $request->ifsc,
                'address' => $request->address,
                'city' => "",
                'state' => "",
                'pincode' => "",
                'cardNo' => $request->card,
                'is_active' => ($order['subCode']== 200)?true:false,
                'response_status' => $order['subCode'], 
                'response' => json_encode($order)
            ]);
            $data['data'] = $order['message'];
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }


    public function transfer(Request $request)
    {
        try {
            $user = auth()->user();
            $data = [];
            $requestBank = $request->ben_id;
            $Beneficiary = Beneficiary::where('uuid',$requestBank)->first();
            $Contract = Contracts::find($request->id);
            if(!$Beneficiary)
            {
                $data['message'] = "Beneficiary not found";
                return  $this->apiResponse($data, 404);
            }
            $transactionId = Str::uuid();
            $data['beneId'] = "BEN".$Beneficiary->uuid;
            $data['amount'] = $user->name;
            $data['transferId'] = $transactionId;
        
            $response = $this->payout->requestAsyncTransfer($data);
            $payout = PayoutTransaction::create([
                'amount' => $request->amount,
                'beneficiary_id' => $Beneficiary->id,
                'contract_id' => $Contract->id,
                'user_id'=> $Beneficiary->user_id,
                'response'=> $response
            ]);

        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    public function subscribe(Request $request)
    {
        try {
            $user = auth()->user();
            $response = $this->payment->createSubscription($user);
            $response = json_decode($response,true);
            $data['data'] = $response;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    public function getPayment(Request $request)
    {
        try {
            $user = auth()->user();
            $response = Subscription::where('user_id',$user->id)->first();
            $data['data'] = $response;
            $data['message'] = 'done';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }
}
