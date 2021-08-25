<?php

namespace App\Models;

use App\Models\Proposals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contracts extends Model
{
    use HasFactory;

    /**
     * Get the proposal associated with the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proposal(): HasOne
    {
        return $this->hasOne(Proposals::class);
    }

    /**
     * Get the user associated with the Contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
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
}
