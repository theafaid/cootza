<?php

namespace App\Generic\Domain\Models;

use App\App\AdvertisementOffers\Domain\Models\AdvertisementOffer;
use App\App\Advertisements\Domain\Models\Advertisement;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->password = bcrypt($user->password);
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function offers()
    {
        return $this->hasMany(AdvertisementOffer::class, 'provided_by', 'id');
    }

    public function hasMadeOfferFor($advertisement)
    {
        return $this->offers()->where(['provided_to' => $advertisement->id])->exists();
    }
}
