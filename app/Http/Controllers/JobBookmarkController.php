<?php

namespace App\Http\Controllers;

use App\Models\JobBookmark;
use Illuminate\Http\Request;

class JobBookmarkController extends Controller
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
            $userId=   auth()->user()->id;
            $isExist = JobBookmark::where('job_id',$request->job_id)->where('user_id',$userId)->first();
            $data = $request->except('_token');
            $data['user_id'] =$userId;
            if(!$isExist){
                $JobBookmark = JobBookmark::create($data);
            }else{
                $isExist->remove();
            }
            
            //$this->images($request,$JobBookmark);
            $data['data'] = "done";
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
     * @param  \App\Models\JobBookmark  $jobBookmark
     * @return \Illuminate\Http\Response
     */
    public function show(JobBookmark $jobBookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobBookmark  $jobBookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(JobBookmark $jobBookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobBookmark  $jobBookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobBookmark $jobBookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobBookmark  $jobBookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobBookmark $jobBookmark)
    {
        //
    }
}
