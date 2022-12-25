<?php

namespace App\Http\Controllers;

use App\PaymentOrder;
use App\Models\Contracts;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\ContractResource;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $per_page = 8;
            if($request->per_page){
                $per_page=$request->per_page;
            }
            $Contracts = Contracts::with('timeentry','proposal','user','client','proposal.jobs')->orderBy('id','desc')->paginate($per_page);

            $data['data'] = ContractResource::collection($Contracts);
            $data['message'] = 'block';
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
            $data = $request->except('_token');
            $data['user_id'] = auth()->user()->id;
            $contracts = Contracts::create($data);

            $orderData = [];
            $orderData['user'] = auth()->user();
            $orderData['order'] = $contracts;
            $orderData['type'] = "contract";
            $order = New PaymentOrder();
            $response = $order->createOrder($orderData);
            $responseData = json_decode($response,true);
            $user = auth()->user();
            $transactions = Transactions::create([
                'user_id' => $user->id,
                'status' =>'pending',
                'response' =>$response,
                'order_id' =>$responseData['order_id'],
                'order_token' =>$responseData['order_token'],
                'amount' =>$responseData['order_amount'],
                'type' =>'normal',
                'transaction_date' => Carbon::now()->format("Y-m-d"),
                'payment_type'=> 'contract-'.$user->uuid,
                'model_type'=> get_class($contracts),
                'model_id'=> $contracts->id
            ]);
            //$this->images($request,$contracts);
            $data['data'] = (isset($responseData)?$responseData['payment_link']:"");
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * contactOrder a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactOrder(Request $request)
    {
        try{
            $data = $request->except('_token');
            $data['user_id'] = auth()->user()->id;
            $contracts = Contracts::whereId($request->id)->first();

            $orderData = [];
            $orderData['user'] = auth()->user();
            $orderData['order'] = $contracts;
            $orderData['type'] = "contract";
            $order = New PaymentOrder();
            $response = $order->createOrder($orderData);
            $responseData = json_decode($response,true);
            $user = auth()->user();
            $transactions = Transactions::create([
                'user_id' => $user->id,
                'status' =>'pending',
                'response' =>$response,
                'order_id' =>$responseData['order_id'],
                'order_token' =>$responseData['order_token'],
                'amount' =>$responseData['order_amount'],
                'type' =>'normal',
                'transaction_date' => Carbon::now()->format("Y-m-d"),
                'payment_type'=> 'contract-'.$user->uuid,
                'model_type'=> get_class($contracts),
                'model_id'=> $contracts->id
            ]);
            //$this->images($request,$contracts);
            $data['data'] = $contracts;
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
     * @param  \App\Models\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        try{
            $data = $request->except(['_token']);
            // $data['user_id'] = auth()->user()->id;
            $Contracts = Contracts::with('timeentry','proposal','user','client','proposal.jobs')->where('uuid',$id)->first();
            //$this->images($request,$Contracts);
            $data['data'] = new ContractResource($Contracts);
            $data['message'] = 'show Contracts';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contracts $contracts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contracts $contracts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contracts $contracts)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request,$id)
    {
        try {
            //code...
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    public function status(Request $request,$id)
    {
        try {
            $contract = Contracts::where('id',$id)->first();
            $contract->status = $request->status;
            $contract->save();
            $data['data'] = $contract;
            $data['message'] = 'status updated';
            return  $this->apiResponse($data,200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    public function jobs(Request $request)
    {
        try {
            $user = auth()->user();
            $contract = Contracts::with('proposal','proposal.jobs')->where('user_id',$user->id)->get();
         
            $data['data'] = $contract;
            $data['message'] = 'status updated';
            return  $this->apiResponse($data,200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
