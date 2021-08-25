<?php

namespace App\Http\Controllers;

use App\Models\Transations;
use Illuminate\Http\Request;

class TransationsController extends Controller
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
            $Transations =new Transations();
            $Transations->create($request->except('_token'));
            $success['data'] = $Transations;
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
     * @param  \App\Models\Transations  $transations
     * @return \Illuminate\Http\Response
     */
    public function show(Transations $transations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transations  $transations
     * @return \Illuminate\Http\Response
     */
    public function edit(Transations $transations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transations  $transations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transations $transations)
    {
        try {
            $transations->update($request->except('_token'));
            $success['data'] = $transations;
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
     * @param  \App\Models\Transations  $transations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transations $transations)
    {
        //
    }
}
