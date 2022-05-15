<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $language = Language::all();
            $education = Education::all();
            $certificate = Certificate::all();
            $user = User::with('preference','language','education','testimonial','employement','expirence')->paginate(8);
            $data['data']['user'] = $user;
            $data['data']['education'] = $education;
            $data['data']['certificate'] = $certificate;
            $data['message'] = 'created';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try{
            $language = Language::all();
            $education = Education::all();
            $certificate = Certificate::all();
            $user = User::with('preference','language','education','testimonial','employement','expirence')->find($id);
            $data['data']['user'] = $user;
            $data['data']['education'] = $education;
            $data['data']['certificate'] = $certificate;
            $data['data']['language'] = $language;
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $id = auth()->user()->id;
            $user = User::find($id);
            $user->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$user);
            $data['data'] = $user;
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request,$search)
    {
        try{
            $search = trim($search);
            $user = User::where('name','like','%'.$search.'%')->orwhere('email','like','%'.$search.'%')->get();
            //$this->images($request,$user);
            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    public function validateUser(Request $request,$id)
    {
        try {
            $user = User::where('email',$request->email)->first();
            if(!$user)
            {
                $user = New User();
                $user->email = $request->email;
                $user->save();
            }else{
                $data['message'] = "user already exist";
                return  $this->apiResponse($data,404);
            }
            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }   
    }
}
