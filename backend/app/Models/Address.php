<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'address_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
        'country',
        'is_default_shipping',
        'is_default_billing',
    ];

    protected $casts = [
        'is_default_shipping' => 'boolean',
        'is_default_billing' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shippingOrders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id', 'address_id');
    }

    public function billingOrders()
    {
        return $this->hasMany(Order::class, 'billing_address_id', 'address_id');
    }
}
