<?php

namespace App\Models;

use App\Models\Contracts;
use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeEntry extends Model
{
    use HasFactory,UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'user_id', 'job_id', 'start_time', 'end_time', 'duration','contract_id','date'];

    /**
     * Get all of the attachment for the TimeEntry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachment(): HasMany
    {
        return $this->hasMany(TimeEntryAttachment::class);
    }

    /**
     * Get the contract that owns the TimeEntry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contracts::class);
    }
}
