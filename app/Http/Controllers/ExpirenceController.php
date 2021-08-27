<?php

namespace App\Http\Controllers;

use App\Models\Expirence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpirenceController extends Controller
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
            $Expirence = Expirence::paginate($per_page);

            $data['data'] = $Expirence;
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
            $Expirence = Expirence::create($request->except('_token'));
            $this->images($request,$Expirence);
            $data['data'] = $Expirence;
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
     * @param  \App\Expirence  $Expirence
     * @return \Illuminate\Http\Response
     */
    public function show(Expirence $Expirence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expirence  $Expirence
     * @return \Illuminate\Http\Response
     */
    public function edit(Expirence $Expirence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expirence  $Expirence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Expirence = Expirence::find($id);
            $Expirence->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Expirence);
            $data['data'] = $Expirence;
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
     * @param  \App\Expirence  $Expirence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expirence $Expirence)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Expirence = new Expirence();
            foreach($all as $k=>$a){
                $Expirence = $Expirence->where($k,'like','%'.$a. '%');
            }
            $Expirence =$Expirence->paginate(8);
            $data['data'] =  $Expirence;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
