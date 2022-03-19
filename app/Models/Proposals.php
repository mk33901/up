<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory,UuidTraits;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id','user_id','rate','uuid','description'];
}
