<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayoutTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'amount',
        'beneficiary_id',
        'contract_id',
        'user_id',
        'status',
        'response',
        'reference'
    ];

    /**
     * Get the beneficiary that owns the PayoutTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class, 'id', 'beneficiary_id');
    }
}
