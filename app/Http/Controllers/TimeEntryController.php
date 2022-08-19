<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeEntryController extends Controller
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
            $TimeEntry = TimeEntry::with('attachment')->paginate($per_page);

            $data['data'] = $TimeEntry;
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
            $TimeEntry = TimeEntry::create($data);
            //$this->images($request,$TimeEntry);
            $data['data'] = $TimeEntry;
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
     * @param  \App\TimeEntry  $TimeEntry
     * @return \Illuminate\Http\Response
     */
    public function show(TimeEntry $TimeEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeEntry  $TimeEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeEntry $TimeEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeEntry  $TimeEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data =$request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $TimeEntry = TimeEntry::find($id);
            $TimeEntry->update($data);
            //$this->images($request,$TimeEntry);
            $data['data'] = $TimeEntry;
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
     * @param  \App\TimeEntry  $TimeEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeEntry $TimeEntry)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $TimeEntry = new TimeEntry();
            foreach($all as $k=>$a){
                $TimeEntry = $TimeEntry->where($k,'like','%'.$a. '%');
            }
            $TimeEntry =$TimeEntry->paginate(8);
            $data['data'] =  $TimeEntry;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
