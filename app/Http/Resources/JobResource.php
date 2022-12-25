<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobResource extends JsonResource
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
            'budget' => $this->budget,
            'hexa_coin' => $this->hexa_coin,
            'budget_type' => $this->budget_type,
            'category_id' => $this->category_id,
            'categories' => $this->category->name,
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'description' => $this->description,
            'draft' => $this->draft,
            'edit_scope' => $this->edit_scope,
            'expiry_at' => $this->expiry_at,
            'id' => $this->id,
            'level_experience' => $this->level_experience,
            'max_price' => $this->max_price,
            'speciality_id' => $this->speciality_id,
            'specializations' => $this->speciality->name,
            'status' => $this->status,
            'time' => $this->time,
            'title' => $this->title,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid,
        ];
    }
}
