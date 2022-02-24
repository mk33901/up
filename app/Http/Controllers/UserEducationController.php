<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

            $data['data'] = $UserEducation;
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
            $UserEducation = UserEducation::create($request->except('_token'));
            //$this->images($request,$UserEducation);
            $data['data'] = $UserEducation;
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
            $UserEducation = UserEducation::find($id);
            $UserEducation->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$UserEducation);
            $data['data'] = $UserEducation;
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
            $data['data'] =  $UserEducation;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
