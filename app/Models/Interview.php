<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class Interview extends Model
{
    use HasFactory,UuidTraits;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'job_id', 'user_id','description','status'];
}
