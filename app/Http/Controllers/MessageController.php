<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $message = DB::select("SELECT users.id,users.name,m.content
FROM messages m join users on users.id=m.from_id
WHERE m.to_id = " . $id . " AND
      m.id = (SELECT MAX(m2.id)
                      FROM messages m2
                      WHERE m2.to_id = m.to_id AND
                            m2.from_id = m.from_id 
                     )  
ORDER BY `m`.`to_id`  DESC
");
            $success['data'] = $message;
            $success['success'] = true;
            $success['message'] = "Post Created";
            return $this->apiResponse($success,200);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = $e->getMessage();
            return $this->apiResponse($success, 401);
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
        try {
            $data = $request->except('_token');
            $data['from_id'] = auth()->user()->id;
            $Message = Message::create($data);
            //$this->images($request,$Message);
            $data['data'] = $Message;
            $data['message'] = 'created';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $Message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $Message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Message = Message::find($id);
            $Message->update($request->except(['_token', 'id', 'created_at', 'updated_at']));
            //$this->images($request,$Message);
            $data['data'] = $Message;
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
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $Message)
    {
        //
    }

    public function search(Request $request)
    {
        try {
            $all = $request->all();
            $Message = new Message();
            foreach ($all as $k => $a) {
                $Message = $Message->where($k, 'like', '%' . $a . '%');
            }
            $Message = $Message->paginate(8);
            $data['data'] =  $Message;
            $data['message'] = 'block';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }
}
