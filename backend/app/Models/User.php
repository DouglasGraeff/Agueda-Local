<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasApiTokens;

    protected $table = 'user_info';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type_id',
        'uuid',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'user_id', 'id');
    }

    /**
     * Get route model binding using UUID
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
