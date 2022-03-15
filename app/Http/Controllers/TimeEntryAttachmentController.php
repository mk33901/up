<?php

namespace App\Http\Controllers;

use App\Models\TimeEntryAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeEntryAttachmentController extends Controller
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
            $TimeEntryAttachment = TimeEntryAttachment::paginate($per_page);

            $data['data'] = $TimeEntryAttachment;
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
            $TimeEntryAttachment = TimeEntryAttachment::create($request->except('_token'));
            //$this->images($request,$TimeEntryAttachment);
            $data['data'] = $TimeEntryAttachment;
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
     * @param  \App\TimeEntryAttachment  $TimeEntryAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(TimeEntryAttachment $TimeEntryAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeEntryAttachment  $TimeEntryAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeEntryAttachment $TimeEntryAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeEntryAttachment  $TimeEntryAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $TimeEntryAttachment = TimeEntryAttachment::find($id);
            $TimeEntryAttachment->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$TimeEntryAttachment);
            $data['data'] = $TimeEntryAttachment;
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
     * @param  \App\TimeEntryAttachment  $TimeEntryAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeEntryAttachment $TimeEntryAttachment)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $TimeEntryAttachment = new TimeEntryAttachment();
            foreach($all as $k=>$a){
                $TimeEntryAttachment = $TimeEntryAttachment->where($k,'like','%'.$a. '%');
            }
            $TimeEntryAttachment =$TimeEntryAttachment->paginate(8);
            $data['data'] =  $TimeEntryAttachment;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
