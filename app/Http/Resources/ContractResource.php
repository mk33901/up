<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContractResource extends JsonResource
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
            'allow_time_entry' => $this->allow_time_entry,
            'automatic_amount' => $this->automatic_amount,
            'client' => $this->client,
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'id' => $this->id,
            'job_titile' => $this->job_titile,
            'last_payment' => $this->last_payment,
            'payment_option' => $this->payment_option,
            'price' => $this->price,
            'proposal' => new ProposalResource($this->whenLoaded('proposal')) ,
            'proposal_id' => $this->proposal_id,
            'start_date' => $this->start_date,
            'status' => $this->status,
            'timeentry' => $this->timeentry,
            'updated_at' => $this->updated_at,
            'user' => $this->user,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid,
            'weekly_limit' => $this->weekly_limit
        ];
    }
}
