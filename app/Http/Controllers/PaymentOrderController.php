<?php

namespace App\Http\Controllers;

use App\Models\PaymentOrder;
use Illuminate\Http\Request;
use App\PaymentOrder as PaymentOrderClass;

class PaymentOrderController extends Controller
{
    public PaymentOrderClass $paymentorder;
    public function __construct(PaymentOrderClass $paymentorder) {
        $this->paymentorder = $paymentorder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = auth()->user();
            $cards = $this->paymentorder->getSavedCard([],$users->uuid);
            $data['data'] = $cards;
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
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
        try{
            $users = auth()->user();
            $order = $this->paymentorder->createOrder($request->all());
            $data['data'] = $order;
            $data['message'] = 'done';
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
        try{
            $users = auth()->user();
            $order = $this->paymentorder->payOrder($request->all());
            $data['data'] = $order;
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
