<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transactions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_id',
        'status',
        'transaction_date',
        'response',
        'payment_type',
        'order_id',
        'order_token',
        'payment_response',
        'amount',
    ];

    /**
     * Get the user that owns the Transactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs that owns the Transactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobs(): BelongsTo
    {
        return $this->belongsTo(Jobs::class);
    }
}
