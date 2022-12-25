<?php

namespace App\Http\Controllers;

use App\Models\Invites;
use Illuminate\Http\Request;

class InvitesController extends Controller
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
            $user_id = auth()->user()->id;
            $invites = Invites::with('job','users')->paginate($per_page);

            $data['data'] = $invites;
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
            $data = $request->except(['_token']);
            // $data['user_id'] = auth()->user()->id;
            $proposal = Invites::where('job_id',$data['job_id'])->where('user_id',$data['user_id'])->first();
            if($proposal)
            {
                $response['error'] = true;
                $response['message'] = 'Invites Already exist for this job and User';
                return  $this->apiResponse($response,200);
            }
            $Invites = Invites::create($data);
            //$this->images($request,$Invites);
            $data['data'] = $Invites;
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
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function show(Invites $invites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function edit(Invites $invites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $invites = Invites::find($id);
            $invites->update($request->except($data));
            //$this->images($request,$invites);
            $data['data'] = $invites;
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
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invites $invites)
    {
        //
    }
}
