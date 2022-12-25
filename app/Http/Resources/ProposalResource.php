<?php

namespace App\Http\Resources;

use App\Http\Resources\JobResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProposalResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'created_at' =>  $this->created_at,
            'deleted_at' =>  $this->deleted_at,
            'description' =>  $this->description,
            'hired' =>  $this->hired,
            'id' =>  $this->id,
            'job_id' =>  $this->job_id,
            'jobs' =>  new JobResource($this->whenLoaded('jobs')),
            'messaged' =>  $this->messaged,
            'question' =>  $this->question,
            'rate' =>  $this->rate,
            'shortlisted' =>  $this->shortlisted,
            'status' =>  $this->status,
            'updated_at' =>  $this->updated_at,
            'user_id' =>  $this->user_id,
            'user' =>  $this->user,
            'uuid' => $this->uuid
        ];
    }
}
