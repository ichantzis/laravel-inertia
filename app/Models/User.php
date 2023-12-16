<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function listings(): HasMany
    {
        return $this->hasMany(
            \App\Models\Listing::class,
            'by_user_id'
        );
    }

    public function offers(): HasMany
    {
        return $this->hasMany(\App\Models\Offer::class, 'bidder_id');
    }

    // The function below is not needed in Laravel 10. Passwords are hashed by default
    // function to hash its value when it's called
    // protected function password(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $value,
    //         set: fn (string $value) => Hash::make($value),
    //     );
    // }
}
