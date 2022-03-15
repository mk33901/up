<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeEntryAttachment extends Model
{
    use HasFactory;
    

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'time_entry_id', 'name', 'time'];

    /**
     * Get the timeentry that owns the TimeEntryAttachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timeentry(): BelongsTo
    {
        return $this->belongsTo(TimeEntry::class);
    }

}
