<?php

namespace App\Models;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;
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
