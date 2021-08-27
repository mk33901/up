<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalsController extends Controller
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
            $Proposals = Proposals::paginate($per_page);

            $data['data'] = $Proposals;
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
            $Proposals = Proposals::create($request->except('_token'));
            $this->images($request,$Proposals);
            $data['data'] = $Proposals;
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
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function show(Proposals $Proposals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposals $Proposals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Proposals = Proposals::find($id);
            $Proposals->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Proposals);
            $data['data'] = $Proposals;
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
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposals $Proposals)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Proposals = new Proposals();
            foreach($all as $k=>$a){
                $Proposals = $Proposals->where($k,'like','%'.$a. '%');
            }
            $Proposals =$Proposals->paginate(8);
            $data['data'] =  $Proposals;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
