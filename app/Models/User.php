<?php

namespace App\Models;

use App\Models\JobBookmark;
use App\Models\UserPreference;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserLanguage;
use App\Models\UserEducation;
use App\Traits\UuidTraits;
use App\Models\Portfolio;
use App\Models\HexaTransaction;
use App\Models\JobReview;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, UuidTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'cover',
        'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the jobs for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }

    /**
     * Get the client associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Get the preference associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preference(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    /**
     * Get all of the bookmark for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmark(): HasMany
    {
        return $this->hasMany(JobBookmark::class);
    }

    /**
     * Get all of the language for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function language(): HasMany
    {
        return $this->hasMany(UserLanguage::class);
    }

    /**
     * Get all of the education for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education(): HasMany
    {
        return $this->hasMany(UserEducation::class);
    }

    /**
     * Get all of the testimonial for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testimonial(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
    /**
     * Get all of the employement for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employement(): HasMany
    {
        return $this->hasMany(Employement::class);
    }

    /**
     * Get all of the expirence for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expirence(): HasMany
    {
        return $this->hasMany(Expirence::class);
    }

    /**
     * Get all of the portfolio for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolio(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Get all of the transactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transactions::class);
    }

    /**
     * Get all of the proposal for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposal(): HasMany
    {
        return $this->hasMany(Proposals::class);
    }

    /**
     * Get all of the invites for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites(): HasMany
    {
        return $this->hasMany(Invites::class);
    }

    /**
     * Get all of the hexatransaction for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hexatransaction(): HasMany
    {
        return $this->hasMany(HexaTransaction::class);
    }

    public function getBalance()
    {
        $credit = $this->hexatransaction->where('type','credit')->sum('hexa_coin');
        $debit = $this->hexatransaction->where('type','debit')->sum('hexa_coin');
        return $debit - $credit;
    }

    /**
     * Get all of the jobReview for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review(): HasMany
    {
        return $this->hasMany(JobReview::class);
    }

    /**
     * Get all of the userBookmark for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userBookmark(): HasMany
    {
        return $this->hasMany(UserBookmark::class, 'user_id', 'id');
    }
}
