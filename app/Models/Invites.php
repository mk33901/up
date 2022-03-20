<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invites extends Model
{
    use HasFactory,UuidTraits;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'user_id', 'uuid','description','status'];

    /**
     * Get the job that owns the Invites
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }

}
