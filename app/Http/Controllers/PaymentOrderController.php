<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PaymentOrder;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\PaymentOrder as PaymentOrderClass;

class PaymentOrderController extends Controller
{
    public PaymentOrderClass $paymentorder;
    public function __construct(PaymentOrderClass $paymentorder)
    {
        $this->paymentorder = $paymentorder;
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
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
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
}
