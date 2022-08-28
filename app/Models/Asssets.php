<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asssets extends Model
{
    use HasFactory,UuidTraits;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid','name','path','type'];
    
    /**
     * Get the taggable that owns the Asssets
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taggable()
    {
        return $this->morphTo();
    }

}
