<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beneficiary extends Model
{
    use HasFactory, UuidTraits;

    protected $fillable = [
        'bank_account','ifsc','address','city','state','pincode','cardNo','is_active','uuid','ben_id'
    ];

    /**
     * Get all of the transactions for the Beneficiary
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(PayoutTransaction::class);
    }
}
