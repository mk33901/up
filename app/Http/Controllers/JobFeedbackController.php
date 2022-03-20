<?php

namespace App\Http\Controllers;

use App\Models\JobFeedback;
use Illuminate\Http\Request;

class JobFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $JobFeedback = JobFeedback::create($data);
            //$this->images($request,$JobFeedback);
            $data['data'] = $JobFeedback;
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
     * @param  \App\Models\JobFeedback  $jobFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(JobFeedback $jobFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobFeedback  $jobFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(JobFeedback $jobFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobFeedback  $jobFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $JobFeedback = JobFeedback::find($id);
            $JobFeedback->update($data);
            //$this->images($request,$JobFeedback);
            $data['data'] = $JobFeedback;
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
     * @param  \App\Models\JobFeedback  $jobFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobFeedback $jobFeedback)
    {
        //
    }
}
