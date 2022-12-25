<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProposalResource;
use App\Models\HexaTransaction;
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
            $Proposals = Proposals::with('jobs','question','user')->where('user_id',$user_id)->paginate($per_page);

            $data['data'] = ProposalResource::collection($Proposals) ;
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
            $data = $request->except(['_token','cover']);
            $data['user_id'] = $user->id;
            $proposal = Proposals::where('job_id',$data['job_id'])->where('user_id',$data['user_id'])->first();
            if($proposal)
            {
                $response['error'] = true;
                $response['message'] = 'Proposal Already exist for this job and User';
                return  $this->apiResponse($response,200);
            }
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
            HexaTransaction::addHexa($Proposals);
            // $this->assets($Proposals,'files',$request->all());
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
            $Proposals = Proposals::with('jobs','question','user')->where('user_id',$user_id)->where('uuid',$id)->first();
            $data['data'] = new ProposalResource($Proposals) ;
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

    public function status(Request $request,$id)
    {
        try{            
            $data['status'] = $request->status;
            $Proposals = Proposals::find($id);
            if(in_array($request->status,['cancelled','withdrow']))
            {
                HexaTransaction::cancelProposal($Proposals);
            }
            $Proposals->update($data);
            $data['data'] = $Proposals;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
