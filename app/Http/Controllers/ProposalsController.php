<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProposalQuestion;

class ProposalsController extends Controller
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
            $Proposals = Proposals::with('jobs','question')->where('user_id',$user_id)->paginate($per_page);

            $data['data'] = $Proposals;
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
            $user = auth()->user();
            $data = $request->except(['_token']);
            $data['user_id'] = $user->id;
            $Proposals = Proposals::create($data);
            //$this->images($request,$Proposals);
            $question = json_decode($request->questions);
            foreach($question as $k=>$q)
            {
                $ProposalQuestions = new ProposalQuestion();
                $ProposalQuestions->user_id = $user->id;
                $ProposalQuestions->question_id = $k;
                $ProposalQuestions->answer = $q;
                $ProposalQuestions->proposal_id = $Proposals->id;
                $ProposalQuestions->save();
            }
            $this->assets($Proposals,'files',$request->all());
            $data['data'] = $Proposals;
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
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        try{
            $user_id = auth()->user()->id;
            $Proposals = Proposals::with('jobs','question')->where('user_id',$user_id)->where('id',$id)->first();
            $data['data'] = $Proposals;
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
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposals $Proposals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->except(['_token','id','created_at','updated_at']);
            $data['user_id'] = auth()->user()->id;
            $Proposals = Proposals::find($id);
            $Proposals->update($request->except($data));
            //$this->images($request,$Proposals);
            $data['data'] = $Proposals;
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
     * @param  \App\Proposals  $Proposals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposals $Proposals)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Proposals = new Proposals();
            foreach($all as $k=>$a){
                $Proposals = $Proposals->where($k,'like','%'.$a. '%');
            }
            $Proposals =$Proposals->paginate(8);
            $data['data'] =  $Proposals;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
