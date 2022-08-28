<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Client;
use App\Models\Education;
use App\Models\Language;
use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JobQuestions;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $language = Language::all();
            $education = Education::all();
            $certificate = Certificate::all();
            $user = User::with('preference', 'language', 'education', 'testimonial', 'employement', 'expirence', 'portfolio')->paginate(8);
            $data['data']['user'] = $user;
            $data['data']['education'] = $education;
            $data['data']['certificate'] = $certificate;
            $data['message'] = 'created';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
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
        try {
            $language = Language::all();
            $education = Education::all();
            $certificate = Certificate::all();
            $user = User::with('preference', 'language', 'education', 'testimonial', 'employement', 'expirence', 'portfolio','portfolio.assets')->find($id);
            $data['data']['user'] = $user;
            $data['data']['education'] = $education;
            $data['data']['certificate'] = $certificate;
            $data['data']['language'] = $language;
            $data['message'] = 'created';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
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
        try {
            $id = auth()->user()->id;
            $user = User::find($id);
            $user->update($request->except(['_token', 'id', 'created_at', 'updated_at']));
            //$this->images($request,$user);
            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
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
    public function search(Request $request, $search)
    {
        try {
            $search = trim($search);
            $user = User::where('name', 'like', '%' . $search . '%')->orwhere('email', 'like', '%' . $search . '%')->get();
            //$this->images($request,$user);
            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    public function validateUser(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = new User();
                $user->email = $request->email;
                $user->save();
            } else {
                $data['isExist'] = true;
                $data['message'] = "user already exist";
                return  $this->apiResponse($data, 404);
            }
            $data['isExist'] = false;
            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }
    public function start(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                $user = new User();
                $user->name = $request->name;
                $user->save();
            }
            $userPref = UserPreference::where('user_id', $user->id)->first();
            if (!$userPref) {
                $userPref = new UserPreference();
                $userPref->user_id = $user->id;
            }
            if ($userPref) {
                $userPref->title = $request->title;
                $userPref->description = $request->overview;
                $userPref->skill = $request->skill;
                $userPref->hourly_rate = $request->budget;
            }
            $userPref->save();

            $data['data'] = $user;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobs  $Jobs
     * @return \Illuminate\Http\Response
     */
    public function jobs(Request $request, $id)
    {
        try {
            $user_id = (auth()->user()) ? auth()->user()->id : 0;
            $Jobs = DB::select("SELECT
            jobs.*,
            categories.name as categories,
            specializations.name as specializations,
            job_preferences.job_id,job_preferences.english_level,job_preferences.hours_per_week,job_preferences.hire_date,job_preferences.no_of_professionals,job_preferences.type_of_talent,job_preferences.location,
            clients.user_id,clients.uuid,clients.name,clients.company_name,clients.company_website,clients.company_tag_line,clients.company_description,clients.company_owner,clients.company_phone,clients.company_vat,clients.company_timezone,clients.company_country,clients.company_address,clients.company_city,clients.company_zip,
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
            left join job_bookmarks on  job_bookmarks.job_id=jobs.id and job_bookmarks.user_id=" . $user_id . "
             where jobs.user_id='" . $user_id . "'");
            $questions = JobQuestions::where('job_id', $id)->get();
            $data['data'] = $Jobs;
            $data['data']['questions'] = $questions;
            $data['message'] = 'block';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    public function profile(Request $request)
    {
        try {
            $data = $request->except('_token');
            $client = Client::where('user_id', auth()->user()->id)->first();
            $client->update($data);
            $data['data'] = $client;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }
}
