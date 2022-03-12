<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class Education extends Model
{
    use HasFactory,UuidTraits;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid','name'];

}
