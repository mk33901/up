<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;

class ProposalsController extends Controller
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
        try {
            $Proposals =new Proposals();
            $Proposals->create($request->except('_token'));
            $success['data'] = $Proposals;
            $success['success'] = true;
            $success['message'] = "Success";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error";
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposals  $proposals
     * @return \Illuminate\Http\Response
     */
    public function show(Proposals $proposals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposals  $proposals
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposals $proposals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposals  $proposals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposals $proposals)
    {
        try {
            $proposals->update($request->except('_token'));
            $success['data'] = $proposals;
            $success['success'] = true;
            $success['message'] = "Success";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error";
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposals  $proposals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposals $proposals)
    {
        //
    }
}
