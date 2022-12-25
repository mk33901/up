<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPreference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'job_id', 'english_level', 'hours_per_week', 'hire_date', 'no_of_professionals', 'type_of_talent', 'location'];
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
