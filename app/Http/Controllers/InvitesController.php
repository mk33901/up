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
            $data = $request->except(['_token']);
            // $data['user_id'] = auth()->user()->id;
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
    public function update(Request $request, Invites $invites)
    {
        //
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
