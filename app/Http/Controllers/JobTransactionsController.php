<?php

namespace App\Http\Controllers;

use App\Models\JobTransactions;
use Illuminate\Http\Request;

class JobTransactionsController extends Controller
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
            $JobTransactions = JobTransactions::paginate($per_page);

            $data['data'] = $JobTransactions;
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
            $JobTransactions = JobTransactions::create($data);
            //$this->images($request,$JobTransactions);
            $data['data'] = $JobTransactions;
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
     * @param  \App\Models\JobTransactions  $jobTransactions
     * @return \Illuminate\Http\Response
     */
    public function show(JobTransactions $jobTransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTransactions  $jobTransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTransactions $jobTransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTransactions  $jobTransactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $JobTransactions = JobTransactions::find($id);
            $JobTransactions->update($data);
            //$this->images($request,$JobTransactions);
            $data['data'] = $JobTransactions;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTransactions  $jobTransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTransactions $jobTransactions)
    {
        //
    }
}
