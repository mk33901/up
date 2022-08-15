<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Contracts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid','job_id','user_id','contract_id','amount','status','procced_at','response'
    ];

    /**
     * Get the user that owns the JobTransactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the jobs that owns the JobTransactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobs(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }

    /**
     * Get the contract that owns the JobTransactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contracts::class);
    }
}
