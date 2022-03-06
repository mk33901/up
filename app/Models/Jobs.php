<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Asssets;
use App\Traits\UuidTraits;
use App\Models\JobQuestions;
use App\Models\JobPreference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory,UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','category_id','speciality_id','edit_scope','time','level_experience','budget'];

    /**
     * Get the category that owns the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }
    
    /**
     * Get the speciality that owns the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Skills::class);
    }

    /**
     * Get the preference that owns the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the preference associated with the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preference(): HasOne
    {
        return $this->hasOne(JobPreference::class);
    }

    /**
     * Get the preference that owns the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Get all of the assets for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets(): HasMany
    {
        return $this->hasMany(Asssets::class);
    }

    /**
     * Get all of the questions for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(JobQuestions::class);
    }
}
