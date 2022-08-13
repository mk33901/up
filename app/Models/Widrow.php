<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Widrow extends Model
{
    use HasFactory, UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'user_id', 'ben_id','amount','status','response','proceed_at','is_completed'];

    /**
     * Get the user that owns the Widrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Widrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
