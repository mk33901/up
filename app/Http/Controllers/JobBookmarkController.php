<?php

namespace App\Http\Controllers;

use App\Models\JobBookmark;
use App\Models\UserBookmark;
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
            $isBookmark = true;
            if(!$isExist){
                $JobBookmark = JobBookmark::create($data);
            }else{
                $isBookmark = false;
                $isExist->delete();
            }
            
            //$this->images($request,$JobBookmark);
            $data['data'] = $isBookmark;
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


    public function userstore(Request $request)
    {
        try{
            $userId=   auth()->user()->id;
            $isExist = UserBookmark::where('user_id',$request->user_id)->where('client_id',$userId)->first();
            $data = $request->except('_token');
            $data['client_id'] =$userId;
            $isBookmark = true;
            if(!$isExist){
                $UserBookmark = UserBookmark::create($data);
            }else{
                $isBookmark = false;
                $isExist->delete();
            }
            
            //$this->images($request,$JobBookmark);
            $data['data'] = $isBookmark;
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
