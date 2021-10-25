<?php

namespace App\Models;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPreference extends Model
{
    use HasFactory;

    /**
     * Get the job that owns the JobPreference
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }
}
