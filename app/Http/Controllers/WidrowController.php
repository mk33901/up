<?php

namespace App\Http\Controllers;

use App\Models\Widrow;
use Illuminate\Http\Request;

class WidrowController extends Controller
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
            $data = $request->except('_token');
            $data['user_id'] = auth()->user()->id;
            $Widrow = Widrow::create($data);
            //$this->images($request,$Widrow);
            $data['data'] = $Widrow;
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
     * @param  \App\Models\Widrow  $widrow
     * @return \Illuminate\Http\Response
     */
    public function show(Widrow $widrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Widrow  $widrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Widrow $widrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Widrow  $widrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $Widrow = Widrow::find($id);
            $Widrow->update($data);
            //$this->images($request,$Widrow);
            $data['data'] = $Widrow;
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
     * @param  \App\Models\Widrow  $widrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widrow $widrow)
    {
        //
    }
}
