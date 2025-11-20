<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';
    protected $primaryKey = 'wishlist_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(WishlistItem::class, 'wishlist_id', 'wishlist_id');
    }
}
