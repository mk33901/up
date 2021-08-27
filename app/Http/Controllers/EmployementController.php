<?php

namespace App\Http\Controllers;

use App\Models\Employement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployementController extends Controller
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
            $Employement = Employement::paginate($per_page);

            $data['data'] = $Employement;
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
            $Employement = Employement::create($request->except('_token'));
            $this->images($request,$Employement);
            $data['data'] = $Employement;
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
     * @param  \App\Employement  $Employement
     * @return \Illuminate\Http\Response
     */
    public function show(Employement $Employement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employement  $Employement
     * @return \Illuminate\Http\Response
     */
    public function edit(Employement $Employement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employement  $Employement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Employement = Employement::find($id);
            $Employement->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Employement);
            $data['data'] = $Employement;
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
     * @param  \App\Employement  $Employement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employement $Employement)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Employement = new Employement();
            foreach($all as $k=>$a){
                $Employement = $Employement->where($k,'like','%'.$a. '%');
            }
            $Employement =$Employement->paginate(8);
            $data['data'] =  $Employement;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
