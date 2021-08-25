<?php

namespace App\Http\Controllers;

use App\Models\Expirence;
use Illuminate\Http\Request;

class ExpirenceController extends Controller
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
            $Expirence =new Expirence();
            $Expirence->create($request->except('_token'));
            $success['data'] = $Expirence;
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
     * @param  \App\Models\Expirence  $expirence
     * @return \Illuminate\Http\Response
     */
    public function show(Expirence $expirence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expirence  $expirence
     * @return \Illuminate\Http\Response
     */
    public function edit(Expirence $expirence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expirence  $expirence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expirence $expirence)
    {
        try {
            $expirence->update($request->except('_token'));
            $success['data'] = $expirence;
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
     * @param  \App\Models\Expirence  $expirence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expirence $expirence)
    {
        //
    }
}
