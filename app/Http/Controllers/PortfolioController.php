<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
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
            $Portfolio = Portfolio::paginate($per_page);
         
            $data['data'] = $Portfolio;
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
            $Portfolio = Portfolio::create($data);
            $this->assets($Portfolio,'files',$request->all());
            $data['data'] = $Portfolio;
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
     * @param  \App\Portfolio  $Portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $Portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $Portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $Portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $Portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $Portfolio = Portfolio::find($id);
            $Portfolio->update($data);
            $this->assets($Portfolio,'files',$request->all());
            $data['data'] = $Portfolio;
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
     * @param  \App\Portfolio  $Portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $Portfolio)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Portfolio = new Portfolio();
            foreach($all as $k=>$a){
                $Portfolio = $Portfolio->where($k,'like','%'.$a. '%');
            }
            $Portfolio =$Portfolio->paginate(8);
            $data['data'] =  $Portfolio;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
