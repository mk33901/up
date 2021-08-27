<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationController extends Controller
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
            $Education = Education::paginate($per_page);

            $data['data'] = $Education;
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
            $Education = Education::create($request->except('_token'));
            $this->images($request,$Education);
            $data['data'] = $Education;
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
     * @param  \App\Education  $Education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $Education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $Education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $Education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $Education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Education = Education::find($id);
            $Education->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Education);
            $data['data'] = $Education;
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
     * @param  \App\Education  $Education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $Education)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Education = new Education();
            foreach($all as $k=>$a){
                $Education = $Education->where($k,'like','%'.$a. '%');
            }
            $Education =$Education->paginate(8);
            $data['data'] =  $Education;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
