<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserEducationResource extends JsonResource
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
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'description' => $this->description,
            'education_id' => $this->education_id,
            'from' => $this->from,
            'id' => $this->id,
            'school' => $this->school,
            'study_id' => $this->study_id,
            'to' => $this->to,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid,
        ];
    }
}
