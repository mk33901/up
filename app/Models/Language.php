<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Traits\UuidTraits;

class Language extends Model
{
    use HasFactory,UuidTraits;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','uuid'];
}
