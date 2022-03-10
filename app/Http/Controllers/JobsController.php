<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Skills;
use App\Models\Specialization;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
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
            // $Jobs = Jobs::paginate($per_page);

            $jobs = DB::select("SELECT
            jobs.*,
            categories.name as categories,
            specializations.name as specializations,
            job_preferences.*,
            clients.*
        FROM
            jobs
        JOIN  job_preferences ON
            job_preferences.job_id = jobs.id
        JOIN  categories ON
            categories.id = jobs.category_id
        JOIN  specializations ON
            specializations.id = jobs.speciality_id
        join clients ON
            clients.id=jobs.client_id
            limit 1000");
            $data['data'] = $jobs;
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
        try{
            $categories = Categories::with(['specialization' => function ($query) {
                $query->select('name','category_id','id');
            }])->get();
            $specialization = Specialization::get();
            $skills = Skills::get();
            //$this->images($request,$Jobs);
            $data['data']['skills'] = $skills;
            $data['data']['categories'] = $categories;
            $data['data']['specialization'] = $specialization;
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobRequest $request)
    {
        try{
            $Jobs = Jobs::create($request->except('_token'));
            //$this->images($request,$Jobs);
            $data['data'] = $Jobs;
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
     * @param  \App\Jobs  $Jobs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        try{
            $Jobs = Jobs::find($id);
            $data['data'] = $Jobs;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobs  $Jobs
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobs $Jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobs  $Jobs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Jobs = Jobs::find($id);
            $Jobs->update($request->except(['_token','id','created_at','updated_at']));
            //$this->images($request,$Jobs);
            $data['data'] = $Jobs;
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
     * @param  \App\Jobs  $Jobs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobs $Jobs)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Jobs = new Jobs();
            foreach($all as $k=>$a){
                $Jobs = $Jobs->where($k,'like','%'.$a. '%');
            }
            $Jobs =$Jobs->paginate(8);
            $data['data'] =  $Jobs;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
