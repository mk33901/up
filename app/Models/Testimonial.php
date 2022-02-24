<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class Testimonial extends Model
{
    use HasFactory,UuidTraits;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'user_id', 'first_name', 'last_name', 'email', 'client_linkedin_id', 'client_title', 'project_type', 'description'];
}
