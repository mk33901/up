<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Asssets;
use App\Models\Proposals;
use App\Traits\UuidTraits;
use App\Models\JobBookmark;
use App\Models\JobFeedback;
use App\Models\JobQuestions;
use App\Models\JobPreference;
use App\Models\JobTransactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory,UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','category_id','speciality_id','edit_scope','time','level_experience','budget','client_id','draft','status','expiry_at'];

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
        return $this->hasOne(JobPreference::class,"job_id","id");
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
        return $this->hasMany(JobQuestions::class,"job_id","id");
    }

    /**
     * Get all of the feedback for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(JobFeedback::class);
    }
    
    /**
     * Get all of the bookmark for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmark(): HasMany
    {
        return $this->hasMany(JobBookmark::class);
    }

    /**
     * Get all of the invites for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites(): HasMany
    {
        return $this->hasMany(Invites::class,"job_id","id");
    }

    /**
     * Get all of the proposal for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal(): HasMany
    {
        return $this->hasMany(Proposals::class,"job_id","id");
    }

    /**
     * Get all of the transaction for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transactions::class);
    }

    /**
     * Get all of the jobtransactions for the Jobs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobtransactions(): HasMany
    {
        return $this->hasMany(JobTransactions::class);
    }
}
