<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposalQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['proposal_id','question_id','answer'];


    /**
     * Get the proposals that owns the ProposalQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposals(): BelongsTo
    {
        return $this->belongsTo(Proposals::class);
    }
}
