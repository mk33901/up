<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jobs;

class Proposals extends Model
{
    use HasFactory,UuidTraits;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id','user_id','rate','uuid','description','messaged','shortlisted','hired'];

    /**
     * Get the jobs that owns the Proposals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobs(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }

    /**
     * Get the user that owns the Proposals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
