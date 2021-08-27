<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavouriteController extends Controller
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
            $Favourite = Favourite::paginate($per_page);

            $data['data'] = $Favourite;
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
            $Favourite = Favourite::create($request->except('_token'));
            //$this->images($request,$Favourite);
            $data['data'] = $Favourite;
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
     * @param  \App\Favourite  $Favourite
     * @return \Illuminate\Http\Response
     */
    public function show(Favourite $Favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favourite  $Favourite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favourite $Favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favourite  $Favourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Favourite = Favourite::find($id);
            $Favourite->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$Favourite);
            $data['data'] = $Favourite;
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
     * @param  \App\Favourite  $Favourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favourite $Favourite)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Favourite = new Favourite();
            foreach($all as $k=>$a){
                $Favourite = $Favourite->where($k,'like','%'.$a. '%');
            }
            $Favourite =$Favourite->paginate(8);
            $data['data'] =  $Favourite;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
