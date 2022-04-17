<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Skills;
use App\Models\Categories;
use App\Models\JobBookmark;
use App\Models\JobFeedback;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Models\JobQuestions;

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
            $user_id= ( auth()->user())? auth()->user()->id:0;
            $page = (isset($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
            if($request->per_page){
                $per_page=$request->per_page;
            }
            $offset = ($page > 1) ? ($per_page * ($page - 1)) : 0;
            // $Jobs = Jobs::paginate($per_page);

            $jobs = DB::select("SELECT
            jobs.*,
            categories.name as categories,
            specializations.name as specializations,
            job_preferences.job_id,job_preferences.english_level,job_preferences.hours_per_week,job_preferences.hire_date,job_preferences.no_of_professionals,job_preferences.type_of_talent,job_preferences.location,
            clients.user_id,clients.uuid,clients.name,clients.description,clients.company_name,clients.company_website,clients.company_tag_line,clients.company_description,clients.company_owner,clients.company_phone,clients.company_vat,clients.company_timezone,clients.company_country,clients.company_address,clients.company_city,clients.company_zip,
            job_bookmarks.id as bookmark
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
            left join job_bookmarks on  job_bookmarks.job_id=jobs.id and job_bookmarks.user_id=".$user_id."
            limit ".$offset.", ".$per_page);
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
            $jobQuestions = JobQuestions::where('is_default',1)->where('job_id',0)->get();
            $skills = Skills::get();
            //$this->images($request,$Jobs);
            $data['data']['skills'] = $skills;
            $data['data']['categories'] = $categories;
            $data['data']['specialization'] = $specialization;
            $data['data']['job_questions'] = $jobQuestions;
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
            $data = $request->except('_token', 'english_level', 'hours_per_week', 'hire_date', 'no_of_professionals', 'type_of_talent', 'location');
            $data['user_id'] = auth()->user()->id;
            $data['client_id'] = auth()->user()->id;
            $Jobs = Jobs::create($data);
            $jobPref = JobPreference::create($request->except('_token','title', 'description', 'category_id', 'speciality_id', 'edit_scope', 'time', 'level_experience', 'user_id', 'client_id', 'budget'));
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
            $user_id= ( auth()->user())? auth()->user()->id:0;
            $Jobs = DB::select("SELECT
            jobs.*,
            categories.name as categories,
            specializations.name as specializations,
            job_preferences.job_id,job_preferences.english_level,job_preferences.hours_per_week,job_preferences.hire_date,job_preferences.no_of_professionals,job_preferences.type_of_talent,job_preferences.location,
            clients.user_id,clients.uuid,clients.name,clients.description,clients.company_name,clients.company_website,clients.company_tag_line,clients.company_description,clients.company_owner,clients.company_phone,clients.company_vat,clients.company_timezone,clients.company_country,clients.company_address,clients.company_city,clients.company_zip,
            job_bookmarks.id as bookmark
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
            left join job_bookmarks on  job_bookmarks.job_id=jobs.id and job_bookmarks.user_id=".$user_id."
             where jobs.id='".$id."'");
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

    public function bookmark(Request $request,$id)
    {
        try{
            $newBookmark = New JobBookmark();
            $newBookmark->user_id = auth()->user()->id;
            $newBookmark->job_id = $id;
            $newBookmark->save();
            $data['data'] = [];
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    public function feedback(Request $request,$id)
    {
        try{
            $newBookmark = New JobFeedback();
            $newBookmark->user_id = auth()->user()->id;
            $newBookmark->job_id = $id;
            $newBookmark->reason = $request->reason;
            $newBookmark->feedback = $request->feedback;
            $newBookmark->save();
            $data['data'] = [];
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }


    public function detail(Request $request,$id)
    {
        try{
            $Jobs = Jobs::with('preference','proposal','invites')->find($id);
            $data['data'] = $Jobs;
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    public function users(Request $request,$id)
    {
        try{
            $users = Users::paginate(8);
            $data['data'] = $users;
            $data['message'] = 'done';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
