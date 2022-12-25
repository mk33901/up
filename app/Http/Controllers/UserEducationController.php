<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserEducationResource;

class UserEducationController extends Controller
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
            $UserEducation = UserEducation::paginate($per_page);

            $data['data'] = UserEducationResource::collection($UserEducation);
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
            $UserEducation = UserEducation::create($data);
            //$this->images($request,$UserEducation);
            $data['data'] = new UserEducationResource($UserEducation);
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
     * @param  \App\UserEducation  $UserEducation
     * @return \Illuminate\Http\Response
     */
    public function show(UserEducation $UserEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserEducation  $UserEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEducation $UserEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserEducation  $UserEducation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $UserEducation = UserEducation::find($id);
            $UserEducation->update($data);
            //$this->images($request,$UserEducation);
            $data['data'] = new UserEducationResource($UserEducation);
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
     * @param  \App\UserEducation  $UserEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEducation $UserEducation)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $UserEducation = new UserEducation();
            foreach($all as $k=>$a){
                $UserEducation = $UserEducation->where($k,'like','%'.$a. '%');
            }
            $UserEducation =$UserEducation->paginate(8);
            $data['data'] =  UserEducationResource::collection($UserEducation);
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
