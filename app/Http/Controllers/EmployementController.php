<?php

namespace App\Http\Controllers;

use App\Models\Employement;
use Illuminate\Http\Request;

class EmployementController extends Controller
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
            $Employement =new Employement();
            $Employement->create($request->except('_token'));
            $success['data'] = $Employement;
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
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function show(Employement $employement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function edit(Employement $employement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employement $employement)
    {
        try {
            $employement->update($request->except('_token'));
            $success['data'] = $employement;
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
     * @param  \App\Models\Employement  $employement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employement $employement)
    {
        //
    }
}
