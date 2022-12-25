<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PortfolioResource extends JsonResource
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
            'assets' => $this->assets,
            'completed_date' => $this->completed_date,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'description' => $this->description,
            'id' => $this->id,
            'profile' => $this->profile,
            'skill' => $this->skill,
            'template' => $this->template,
            'title' => $this->title,
            'updated_at' => $this->updated_at,
            'url' => $this->url,
            'user_id' => $this->user_id,
            'uuid' => $this->uuid,
        ];
    }
}
