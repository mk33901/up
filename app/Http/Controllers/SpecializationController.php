<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecializationController extends Controller
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
            $Specialization = Specialization::paginate($per_page);

            $data['data'] = $Specialization;
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
            $Specialization = Specialization::create($request->except('_token'));
            //$this->images($request,$Specialization);
            $data['data'] = $Specialization;
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
     * @param  \App\Specialization  $Specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $Specialization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialization  $Specialization
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialization $Specialization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialization  $Specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Specialization = Specialization::find($id);
            $Specialization->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$Specialization);
            $data['data'] = $Specialization;
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
     * @param  \App\Specialization  $Specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $Specialization)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Specialization = new Specialization();
            foreach($all as $k=>$a){
                $Specialization = $Specialization->where($k,'like','%'.$a. '%');
            }
            $Specialization =$Specialization->paginate(8);
            $data['data'] =  $Specialization;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
