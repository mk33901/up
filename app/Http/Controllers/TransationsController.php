<?php

namespace App\Http\Controllers;

use App\Models\Transations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransationsController extends Controller
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
            $Transations = Transations::paginate($per_page);

            $data['data'] = $Transations;
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
            $Transations = Transations::create($request->except('_token'));
            //$this->images($request,$Transations);
            $data['data'] = $Transations;
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
     * @param  \App\Transations  $Transations
     * @return \Illuminate\Http\Response
     */
    public function show(Transations $Transations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transations  $Transations
     * @return \Illuminate\Http\Response
     */
    public function edit(Transations $Transations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transations  $Transations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Transations = Transations::find($id);
            $Transations->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$Transations);
            $data['data'] = $Transations;
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
     * @param  \App\Transations  $Transations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transations $Transations)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Transations = new Transations();
            foreach($all as $k=>$a){
                $Transations = $Transations->where($k,'like','%'.$a. '%');
            }
            $Transations =$Transations->paginate(8);
            $data['data'] =  $Transations;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
