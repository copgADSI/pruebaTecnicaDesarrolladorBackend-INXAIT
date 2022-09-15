<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\city\City;
use App\Models\raffle\Raffle_winner;
use App\Models\State\State;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'citizenship_card',
        'email',
        'state_id',
        'city_id',
        'habeas_data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name():Attribute    
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value)
        );
    }

    /* RELATIONSHIPS */

    public function state()
    {
        return $this->hasOne(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'id');
    }

    public function raffle_winner()
    {
        return $this->belongsTo(Raffle_winner::class, 'user_id', 'id');
    }
}
