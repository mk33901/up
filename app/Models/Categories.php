<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UuidTraits;

class Categories extends Model
{
    use HasFactory, UuidTraits;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the jobs for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }
    /**
     * Get all of the specialization for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialization()
    {
        return $this->hasMany(Specialization::class,"category_id");
    }

}
