<?php

namespace App\Models;

use App\Models\Proposals;
use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contracts extends Model
{
    use HasFactory,UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid','proposal_id','user_id','client_id','start_date','payment_option','price','weekly_limit','allow_time_entry','automatic_amount','job_titile','description','last_payment'];
    /**
     * Get the proposal associated with the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proposal(): HasOne
    {
        return $this->hasOne(Proposals::class,'id','proposal_id');
    }

    /**
     * Get the user associated with the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    /**
     * Get the client associated with the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    /**
     * Get all of the timeentry for the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeentry(): HasMany
    {
        return $this->hasMany(TimeEntry::class);
    }
}
