<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpirenceResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid,
        ];
    }
}
