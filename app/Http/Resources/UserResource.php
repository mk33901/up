<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResource extends JsonResource 
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
            // 'language' => UserLanguageResource::collection($this->language),
            // 'level' => $this->level,

            'cover' => $this->cover,
            'balance' => $this->getBalance(),
            'created_at' => $this->created_at,
            'education' => UserEducationResource::collection($this->education),
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'employement' => EmployementResource::collection($this->employement),
            'expirence' => $this->expirence,
            'id' => $this->id,
            'language' => UserLanguageResource::collection($this->language),
            'name' => $this->name,
            'portfolio' => PortfolioResource::collection($this->portfolio),
            'preference' => $this->preference,
            'profile' => $this->profile,
            'testimonial' => $this->testimonial,
            'updated_at' => $this->updated_at,
            'uuid' => $this->uuid
        ];
        return parent::toArray($request);
    }
}
