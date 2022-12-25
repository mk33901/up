<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployementResource extends JsonResource
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
            'city' => $this->city,
            'country' => $this->country,
            'created_at' => $this->created_at,
            'current_company' => $this->current_company,
            'deleted_at' => $this->deleted_at,
            'description' => $this->description,
            'end_date' => $this->end_date,
            'id' => $this->id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'title' => $this->title,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid
        ];
    }
}
