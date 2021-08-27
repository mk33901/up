<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillsController extends Controller
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
            $Skills = Skills::paginate($per_page);

            $data['data'] = $Skills;
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
            $Skills = Skills::create($request->except('_token'));
            $this->images($request,$Skills);
            $data['data'] = $Skills;
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
     * @param  \App\Skills  $Skills
     * @return \Illuminate\Http\Response
     */
    public function show(Skills $Skills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skills  $Skills
     * @return \Illuminate\Http\Response
     */
    public function edit(Skills $Skills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skills  $Skills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Skills = Skills::find($id);
            $Skills->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Skills);
            $data['data'] = $Skills;
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
     * @param  \App\Skills  $Skills
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skills $Skills)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Skills = new Skills();
            foreach($all as $k=>$a){
                $Skills = $Skills->where($k,'like','%'.$a. '%');
            }
            $Skills =$Skills->paginate(8);
            $data['data'] =  $Skills;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
